<?php

namespace App\Jobs;

use App\Models\DomainDnsServer;
use App\Services\SSHService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Throwable;

class ConfigureWebsite implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public int $domainDnsServerId
    ) {}

    public function handle(SSHService $sshService): void
    {
        $domainDnsServer = DomainDnsServer::findOrFail($this->domainDnsServerId);

        # This method is used ot create a user inside /home on the Linux machine
        $sshService->prepareWebsite($domainDnsServer->domain_name, $domainDnsServer->user_id);

        if (!$sshService->isDomainDnsReady($domainDnsServer->domain_name)) {

            Log::info('DNS is not ready for domain: ' . $domainDnsServer->domain_name);

            $this->release(300);

            return;
        }

        Log::info('DNS is ready for domain: ' . $domainDnsServer->domain_name);

        /** This method is used  to create the HTTPS SSL certificate */
        $sshService->createSSLCertificate($domainDnsServer->domain_name, $domainDnsServer->user_id);

        $domainDnsServer->update([
            'status' => 'completed',
        ]);
    }

    /**
     * Handle a job failure.
     *
     * @param Throwable|null $exception
     * @return void
     */
    public function failed(?Throwable $exception): void
    {
        Log::error('ConfigureWebsite job failed', [
            'domain_dns_server_id' => $this->domainDnsServerId,
            'error' => $exception?->getMessage(),
            'file' => $exception?->getFile(),
            'line' => $exception?->getLine(),
            'trace' => $exception?->getTraceAsString(),
        ]);
    }
}
