<?php

namespace App\Http\Controllers;

use App\Services\Payments\HostingPaymentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class OnlinePaymentsController extends Controller
{
    /**
     * Inject the Stripe service.
     */
    public function __construct(private HostingPaymentService $hostingPaymentService)
    {
    }

    /**
     * Verify a successful Stripe Checkout payment.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function checkout(Request $request)
    {
        return $this->hostingPaymentService->checkout($request);
    }

    /**
     * Create a new Stripe subscription.
     *
     * @param Request $request
     * @param string $priceId
     * @param string $plan
     * @return Response
     */
    public function createSubscription(Request $request, string $priceId, string $plan)
    {
        return $this->hostingPaymentService->createSubscription($request, $priceId, $plan);
    }

    /**
     * Cancel the currently active subscription.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function cancelSubscription(Request $request)
    {
        return $this->hostingPaymentService->cancelSubscription($request);
    }

    /**
     * Show the current user's subscription information.
     *
     * @return \Illuminate\View\View
     */
    public function subscriptions()
    {
        $subscription = $this->hostingPaymentService->subscriptionInformation(Auth::user());

        return view('Backend.subscriptions', [
            'subscription' => $subscription,
        ]);
    }

    /**
     * Show the payment failed page.
     *
     * @return  \Illuminate\View\View
     */
    public function fail()
    {
        return view('errors.SubscriptionFailed');
    }
}
