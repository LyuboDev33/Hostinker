<?php

namespace App\Http\Controllers;

use App\Services\DomainService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DomainController extends Controller
{

    public function __construct(
        private DomainService $domainService
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
            'domainName' => ['required', 'string', 'max:35', 'regex:/^[a-zA-Z0-9.-]+$/',],
        ],[
            'domainName.required' => 'Моля въведете домейн.',
            'domainName.string'   => 'Полето задължително трябва да бъде в правилен формат.',
            'domainName.max'      => 'Упсс... превишихте допустимия размер символи.',
            'domainName.regex'    => 'Домейнът може да съдържа само латински букви, цифри, тире и точка.',

        ]);

        $result = $this->domainService->checkDomainAvailability($request->domainName);

        if (!$result['success']) {
            return back()
                ->withInput()
                ->with('error', $result['message']);
        }


        if ( empty($result['results']) || !isset($result['results'][0])) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Възникна грешка при проверката на домейна.'
                );
        }

        $domain = $result['results'][0];


        if (!isset($domain['purchasable']) || $domain['purchasable'] !== true) {
            return back()
                ->withInput()
                ->with(
                    'domainUnavailable',
                    "Домейнът {$domain['domainName']} не е свободен за регистрация."
                );
        }

        return back()
            ->withInput()
            ->with('domainAvailable', $domain);
    }
}
