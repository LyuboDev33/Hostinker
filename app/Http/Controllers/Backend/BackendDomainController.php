<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Services\DomainService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BackendDomainController extends Controller
{

    public function __construct(
        private DomainService $domainService,
    ) {}

    /** Return all the domains */
    public function index()
    {
        $domains = Domain::where('user_id', Auth::id())->get();

        return view('Backend.domains.Index', [
            'domains' => $domains
        ]);
    }

    /**
     * Update domain settings.
     *
     * @param Request $request
     * @param string $domain_name
     * @return RedirectResponse
     */
    public function update(Request $request, string $domain_name): RedirectResponse
    {
        $request->validate([
            'autorenewEnabled' => ['nullable', 'boolean'],
            'privacyEnabled' => ['nullable', 'boolean'],
            'locked' => ['nullable', 'boolean'],
        ]);

        try {
            $this->domainService->updateDomain(
                $domain_name,
                $request->has('autorenewEnabled') ? $request->boolean('autorenewEnabled') : null,
                $request->has('privacyEnabled') ? $request->boolean('privacyEnabled') : null,
                $request->has('locked') ? $request->boolean('locked') : null
            );

            return back()->with(
                'success',
                "Настройките за домейн {$domain_name} бяха обновени успешно."
            );
        } catch (\Exception $exception) {
            return back()->with(
                'error',
                $exception->getMessage()
            );
        }
    }

    /** Return nameservers
     *
     * @param string $domainName
     */
    public function nameServers(string $domainName)
    {
        return view('Backend.domains.nameservers');
    }

    /** Return dns recorrds
     *
     * @param string $domainName
     */
    public function dnsRecords(string $domainName)
    {
        $dnsRecords = $this->domainService->dnsRecords($domainName);

        // dd($dnsRecords);

        return view('Backend.domains.dns-records', [
            'dnsRecords' => $dnsRecords,
            'domainName'     => $domainName
        ]);
    }
}
