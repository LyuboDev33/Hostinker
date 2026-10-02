<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\UserHosting;
use App\Services\SSHService;
use Illuminate\Support\Facades\Auth;

class BackendWebsitesController extends Controller
{
    public function __construct(
        private SSHService $sshService
    ) {
    }

    /**
     * Return all the domains.
     */
    public function index()
    {
        $websites = Domain::where('user_id', Auth::id())->get();

        return view('Backend.websites.Index', [
            'websites' => $websites
        ]);
    }

    /**
     * Show a specific domain.
     *
     * @param string $domainName
     */
    public function show(string $domainName)
    {
        $domain = Domain::where('domain_name', $domainName)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('Backend.websites.show', [
            'website' => $domain
        ]);
    }

    /**
     * Show the databases
     *
     * @param string $website
     */
    public function database(string $website) {
        return view('Backend.websites.databases');
    }

    /**
     * Show the file manager coming from the server.
     *
     * @param string $domainName
     * @param string|null $path
     */
    public function showFileManager(string $domainName, ?string $path = null)
    {
        $domain = Domain::where('domain_name', $domainName)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $hosting = UserHosting::where('user_id', Auth::id())
            ->where('is_active', true)
            ->firstOrFail();

        $rootPath = '/home/' . $hosting->linux_user . '/domains/' . $domain->domain_name . '/public_html';

        $fileManager = $this->sshService->getFileManager($rootPath, $path);

        return view('Backend.websites.files', [
            'domain' => $domain,
            'files' => $fileManager['files'],
            'rootPath' => $rootPath,
            'fileContent' => $fileManager['fileContent'],
            'currentPath' => $fileManager['currentPath'],
        ]);
    }




}
