<?php

namespace App\Http\Controllers;


use App\Models\Domain;
use App\Services\DomainService;
use App\Services\StripeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DomainController extends Controller
{

    public function __construct(
        private DomainService $domainService,
    ) {}

    /**
     * Check domain availability.
     */
    public function domain()
    {
        return view('Frontend.domain.domain-name-serach');
    }


    /**
     * Check the domain availability.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function checkAvailability(Request $request): RedirectResponse
    {
        $request->validate([
            'domainName' => [
                'required',
                'string',
                'max:35',
                'regex:/^[a-zA-Z0-9.-]+$/',
            ],
        ], [
            'domainName.required' => 'Моля въведете домейн.',
            'domainName.string'   => 'Полето задължително трябва да бъде в правилен формат.',
            'domainName.max'      => 'Упсс... превишихте допустимия размер символи.',
            'domainName.regex'    => 'Домейнът може да съдържа само латински букви, цифри, тире и точка.',
        ]);


        try {
            $domain = $this->domainService->checkDomainAvailability($request->domainName);

            return back()
                ->withInput()
                ->with('domainAvailable', $domain);
        } catch (\Exception $exception) {
            return back()
                ->withInput()
                ->with('error', $exception->getMessage());
        }
    }


    /**
     * Add one available domain to the cart.
     *
     * @param string $domainName
     * @return RedirectResponse
     */
    public function addDomainToCart(string $domainName): RedirectResponse
    {
        try {
            $domain = $this->domainService->checkDomainAvailability($domainName);

            $prices = $this->domainService->checkDomainPrice($domain['domainName']);

            session()->put('cart.domain', [
                'name' => $domain['domainName'],
                'prices' => $prices,
            ]);

            return back()->with(
                'successDomainAdd',
                "Домейнът {$domain['domainName']} беше добавен в количката."
            );
        } catch (\Exception $exception) {
            return back()->with(
                'error',
                $exception->getMessage()
            );
        }
    }

    /**
     * Show cart.
     */
    public function cart()
    {
        $domain = session('cart.domain');

        return view('Frontend.domain.cart', [
            'domain' => $domain,
        ]);
    }

    /**
     * Remove the domain from the cart.
     *
     * @return RedirectResponse
     */
    public function cartDestroy(): RedirectResponse
    {
        session()->forget('cart.domain');

        return redirect()
            ->route('domain.cart')
            ->with('success', 'Домейнът беше премахнат от количката.');
    }

    /** Return all TLD pricing */
    public function  getTldPricing()
    {
        dd($this->domainService->getTldPricing());
    }


    /** List all domains */
    public function listAllDomains()
    {
        dd(($this->domainService->listDomains()));
    }


    /** Return the success page */
    public function failPayment()
    {
        return view('Frontend.payments.failPayment');
    }

    /** Return the fail page */
    public function successfullPayment()
    {
        return view('Frontend.payments.successPayment');
    }


    /**
     * Validate the domain and create the Stripe Checkout session.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function registerDomain(Request $request): RedirectResponse
    {
        $request->validate([
            'domainName' => [
                'required',
                'string',
            ],
            'years' => [
                'required',
                'integer',
                'min:1',
                'max:10',
            ],
        ]);

        try {

            $sessionDomain = session('cart.domain');

            if (!$sessionDomain) {
                throw new \Exception(
                    'Няма добавен домейн в количката.'
                );
            }

            $domainName = $request->domainName;
            $years = $request->integer('years');

            if ($domainName !== $sessionDomain['name']) {
                throw new \Exception(
                    'Избраният домейн не съвпада с домейна в количката.'
                );
            }


            $availableDomain = $this->domainService->checkDomainAvailability($domainName);

            $currentPrice = $this->domainService->checkDomainPrice($domainName, [$years]);

            $apiPrice = $currentPrice[$years]['purchase_price'] ?? null;

            $sessionPrice = $sessionDomain['prices'][$years]['purchase_price'] ?? null;

            if ($apiPrice === null || $sessionPrice === null) {
                throw new \Exception(
                    'Неуспешна проверка на цената на домейна.'
                );
            }

            if ((float) $apiPrice !== (float) $sessionPrice) {
                throw new \Exception(
                    'Цената на домейна е променена. Моля, обновете количката и опитайте отново.'
                );
            }


            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_DOMAIN_ACCOUNT'));

            $stripeSession = $stripe->checkout->sessions->create([
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'eur',
                            'product_data' => [
                                'name' => 'Регистрация на домейн ' . $availableDomain['domainName'],
                            ],
                            'unit_amount' => (int) round($apiPrice * 100),
                        ],
                        'quantity' => 1,
                    ],
                ],

                'mode' => 'payment',
                'metadata' => [
                    'domain_name' => $availableDomain['domainName'],
                    'years' => (string) $years,
                    'price' => (string) $apiPrice,
                ],

                'success_url' => route('completeDomainPayment') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('failPayment'),
            ]);

            return redirect()->away($stripeSession->url);
        } catch (\Exception $exception) {

            return back()->with(
                'error',
                $exception->getMessage()
            );
        }
    }

    /**
     * Complete the Stripe payment and register the domain.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function completeDomainPayment(Request $request): RedirectResponse
    {

        try {
            $sessionId = $request->input('session_id');

            if (!$sessionId) {
                dd('no way');
                return redirect()->route('failPayment');
            }

            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_DOMAIN_ACCOUNT'));

            $stripeSession = $stripe->checkout->sessions->retrieve($sessionId);

            if ($stripeSession->payment_status !== 'paid') {
                return redirect()->route('failPayment');
            }

            $domainName = $stripeSession->metadata->domain_name;
            $years = (int) $stripeSession->metadata->years;
            $paidPrice = (float) $stripeSession->metadata->price;


            $availableDomain = $this->domainService->checkDomainAvailability($domainName);
            $result = $this->domainService->registerDomain($availableDomain['domainName'], $years);


            if (  $result['status'] < 200 || $result['status'] >= 300 || empty($result['response']['domain'])) {
                throw new \Exception(
                    'Домейнът беше платен, но регистрацията не беше успешна.'
                );
            }

            $registeredDomain = $result['response']['domain'];


            Domain::create([
                'user_id' => Auth::id(),
                'domain_name' => $registeredDomain['domainName'],
                'price' => $paidPrice,
                'registered_at' => $registeredDomain['createDate'] ?? null,
                'expires_at' => $registeredDomain['expireDate'] ?? null,
                'auto_renew' => $registeredDomain['autorenewEnabled'] ?? false,
            ]);


            session()->forget('cart.domain');

            return redirect()
                ->route('successPayment')
                ->with(
                    'success',
                    "Домейнът {$domainName} беше регистриран успешно."
                );
        } catch (\Exception $exception) {

                    dd($exception);


            return redirect()
                ->route('failPayment')
                ->with(
                    'error',
                    $exception->getMessage()
                );
        }
    }
}
