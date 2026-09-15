<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Services\DNSService;
use App\Services\DomainService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BackendDomainController extends Controller
{

    public function __construct(
        private DomainService $domainService,
        private DNSService $dnsService
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
     * @return View
     */
    public function retrieveNameservers(string $domainName): View
    {
        $domain = $this->domainService->retrieveDomainData($domainName);

        if (($domain['message'] ?? null) === 'Not Found') {
            abort(500);
        }
        return view('Backend.domains.nameservers', [
            'domain' => $domain
        ]);
    }

    /**
     * Update the nameservers for a domain.
     *
     * @param Request $request
     * @param string $domainName
     * @return RedirectResponse
     */
    public function updateNameservers(Request $request, string $domainName): RedirectResponse
    {
        $validated = $request->validate([
            'nameservers' => ['required', 'array'],
        ], [
            'nameservers.required' => 'Моля, въведете nameservers.',
        ]);


        $response = $this->domainService->updateNameservers($domainName, $validated['nameservers']);

        if (isset($response['message'])) {
            return back()
                ->withErrors([
                    'nameservers' => $response['message'],
                ])
                ->withInput();
        }

        return back()->with(
            'success',
            'Nameservers бяха обновени успешно.'
        );
    }

    /** Return dns recorrds
     *
     * @param string $domainName
     */
    public function retrieveDNSrecords(string $domainName)
    {
        $dnsRecords = $this->dnsService->dnsRecords($domainName);

        // dd($dnsRecords);

        return view('Backend.domains.dns-records', [
            'dnsRecords' => $dnsRecords,
            'domainName'     => $domainName
        ]);
    }

  /**
 * Create a new DNS record.
 *
 * @param Request $request
 * @param string $domain
 * @return RedirectResponse
 */
public function createDNSrecord(Request $request, string $domain): RedirectResponse {
    $validated = $request->validate([
        'type' => ['required','in:A,AAAA,ANAME,CNAME,MX,NS,SRV,TXT',],

        'host' => [
            'required',
            'string',
        ],

        'answer' => [
            'required',
            'string',
        ],

        'ttl' => [
            'required',
            'integer',
            'min:300',
        ],

        'priority' => [
            'nullable',
            'required_if:type,MX,SRV',
            'integer',
            'min:0',
        ],
    ], [
        'type.required' => 'Моля, изберете тип на DNS записа.',
        'type.in' => 'Избраният тип DNS запис е невалиден.',

        'host.required' => 'Моля, въведете име / host.',

        'answer.required' => 'Моля, въведете стойност / answer.',

        'ttl.required' => 'Моля, въведете TTL.',
        'ttl.integer' => 'TTL трябва да бъде цяло число.',
        'ttl.min' => 'Минималният TTL, позволен от Name.com, е 300 секунди.',

        'priority.required_if' =>
            'Приоритетът е задължителен за MX и SRV записи.',

        'priority.integer' =>
            'Приоритетът трябва да бъде цяло число.',

        'priority.min' =>
            'Приоритетът не може да бъде отрицателен.',
    ]);

    $record = [
        'type' => $validated['type'],
        'host' => $validated['host'],
        'answer' => $validated['answer'],
        'ttl' => $validated['ttl'],
    ];

    if (in_array($validated['type'], ['MX', 'SRV'], true)) {
        $record['priority'] = $validated['priority'];
    }

    $response = $this->dnsService->createDNSrecord($domain, $record);

    if (isset($response['message'])) {
        return back()
            ->withErrors([
                'dns_record' => $response['message'],
            ])
            ->withInput();
    }

    return back()->with('success', 'DNS записът беше добавен успешно.');
}

}
