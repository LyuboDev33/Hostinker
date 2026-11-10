<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\DNSRecordRequest;
use App\Models\Domain;
use App\Services\DNSService;
use App\Services\DomainService;
use Illuminate\Http\JsonResponse;
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
        $domains = Domain::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Backend.domains.Index', [
            'domains' => $domains
        ]);
    }


    public function renewDomain()
    {
        dd($this->domainService->listDomains());
        try {
            $domainName = 'lubodev.com';
            $years = 1;

            $result = $this->domainService->renewDomain($domainName, $years);

            return response()->json([
                'success' => true,
                'message' => 'Домейнът беше подновен успешно.',
                'data' => $result,
            ]);
        } catch (\Exception $exception) {

            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], 500);
        }
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


    /**
     * Display domain management page.
     *
     * @param string $domainName
     * @return View
     */
    public function domainManage(string $domainName): View
    {
        $domain = Domain::where('domain_name', $domainName)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('Backend.domains.Show', compact('domain'));
    }

    /**
     * Retrieve domain transfer authorization code.
     *
     * @param string $domainName
     * @return RedirectResponse
     */
    public function getDomainAuthCode(string $domainName): RedirectResponse
    {
        try {
            $domain = Domain::where('domain_name', $domainName)
                ->where('user_id', Auth::id())
                ->first();

            if (!$domain) {
                return back()->with('error', 'Домейнът не е намерен или нямате права да го управлявате.');
            }

            $result = $this->domainService->getDomainAuthCode($domain->domain_name);

            if (empty($result['authCode'])) {
                return back()->with('error', 'Не беше намерен код за трансфер на домейна.');
            }

            return back()->with([
                'success' => 'Кодът за трансфер беше извлечен успешно.',
                'auth_code' => $result['authCode'],
            ]);
            
        } catch (\Exception $exception) {
            return back()->with('error', 'Неуспешно извличане на кода за трансфер.');
        }
    }



    /**
     * Change the domain "Locked" status.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function changeDomainLock(Request $request): JsonResponse
    {
        $request->validate([
            'domain_name' => ['required', 'string'],
            'locked' => ['required', 'boolean'],
        ]);


        try {
            $domain = Domain::where('domain_name', $request->domain_name)
                ->where('user_id', Auth::id())
                ->first();

            if (!$domain) {
                return response()->json([
                    'success' => false,
                    'message' => 'Домейнът не е намерен или нямате права да го управлявате.',
                ], 403);
            }

            $locked = $request->boolean('locked');

            $this->domainService->updateDomainLock($domain->domain_name, $locked);

            $domain->update([
                'is_domain_locked' => $locked,
            ]);

            return response()->json([
                'success' => true,
                'message' => $locked
                    ? 'Домейнът беше заключен успешно.'
                    : 'Домейнът беше отключен успешно.',
                'is_domain_locked' => $domain->is_domain_locked,
            ]);
        } catch (\Exception $exception) {

            $statusCode = $exception->getCode() === 409 ? 409 : 500;

            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], $statusCode);
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
    public function createDNSrecord(DNSRecordRequest $request, string $domain): RedirectResponse
    {
        $validated = $request->validated();
        $record = $request->record($validated);

        $response = $this->dnsService->createDNSrecord($domain, $record);

        if (isset($response['message'])) {
            return back()->withErrors(['dns_record' => $response['message']])->withInput();
        }

        return back()->with('success', 'DNS записът беше добавен успешно.');
    }

    /**
     * Update an existing DNS record.
     *
     * @param Request $request
     * @param string $domain
     * @param int $recordId
     * @return RedirectResponse
     */
    public function updateDNSrecord(DNSRecordRequest $request, string $domain, int $recordId): RedirectResponse
    {
        $validated = $request->validated();
        $record = $request->record($validated);

        $response = $this->dnsService->updateDNSrecord($domain, $recordId, $record);

        if (isset($response['message'])) {
            return back()->withErrors(['dns_record' => $response['message']])->withInput();
        }

        return back()->with('success', 'DNS записът беше обновен успешно.');
    }

    /**
     * Delete an existing DNS record.
     *
     * @param string $domain
     * @param int $recordId
     * @return RedirectResponse
     */
    public function deleteDNSrecord(string $domain, int $recordId): RedirectResponse
    {
        $response = $this->dnsService->deleteDNSrecord($domain, $recordId);

        if (isset($response['message'])) {
            return back()->withErrors(['dns_record' => $response['message']]);
        }

        return back()->with('success', 'DNS записът беше изтрит успешно.');
    }

    /** Show the transfer view */
    public function transfer()
    {
        return view('Backend.domains.transfer');
    }
}
