<?php

namespace App\Services;

use App\Models\Admin\VPS;
use phpseclib4\Net\SSH2;
use RuntimeException;

class SSHService
{
    private ?SSH2 $ssh = null;

    public function __construct(
        private VPS $vps
    ) {}

    /**
     * Connect to the VPS assigned to the hosting account.
     */
    private function ssh(): SSH2
    {
        if ($this->ssh !== null && $this->ssh->isConnected()) {
            return $this->ssh;
        }

        $ssh = new SSH2($this->vps->host, $this->vps->port);

        if (!$ssh->login(
            $this->vps->username,
            $this->vps->password
        )) {
            throw new RuntimeException(
                "SSH login failed for VPS #{$this->vps->id}."
            );
        }

        return $this->ssh = $ssh;
    }

    /**
     * Execute a command and verify its exit status.
     */
    private function execute(string $command): string
    {
        $ssh = $this->ssh();

        $output = $ssh->exec($command);

        $exitStatus = $ssh->getExitStatus();

        if ($output === false || $exitStatus !== 0) {
            throw new RuntimeException(
                "SSH command failed on VPS #{$this->vps->id}. " .
                "Exit status: " . var_export($exitStatus, true) .
                ". Output: " . (string) $output
            );
        }

        return $output;
    }

    /**
     * Generate a unique Linux username for a hosting account.
     *
     * The ID should be user_hosting.id, not users.id.
     */
    private function linuxUsername(int $hostingId): string
    {
        return "server_user{$hostingId}";
    }

    /**
     * Validate a domain before using it in paths or commands.
     */
    private function validateDomain(string $domainName): string
    {
        $domainName = strtolower(trim($domainName));

        if (
            strlen($domainName) > 253 ||
            !filter_var($domainName, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME) ||
            !str_contains($domainName, '.')
        ) {
            throw new RuntimeException('Invalid domain name.');
        }

        return $domainName;
    }

    /**
     * Create the Linux user if it doesn't already exist.
     */
    public function createLinuxUser(int $hostingId): void
    {
        $username = $this->linuxUsername($hostingId);
        $homeDirectory = "/home/{$username}";

        $ssh = $this->ssh();

        $ssh->exec(
            'id -u ' . escapeshellarg($username) . ' >/dev/null 2>&1'
        );

        if ($ssh->getExitStatus() === 0) {
            return;
        }

        $this->execute(
            'sudo -n useradd -m -d ' .
            escapeshellarg($homeDirectory) .
            ' -s /usr/sbin/nologin ' .
            escapeshellarg($username)
        );
    }

    /**
     * Prepare the Linux user and website directory.
     */
    public function prepareWebsite(
        string $domainName,
        int $hostingId
    ): void {
        $domainName = $this->validateDomain($domainName);

        $this->createLinuxUser($hostingId);

        $username = $this->linuxUsername($hostingId);

        $homeDirectory = "/home/{$username}";

        $websiteDirectory =
            "{$homeDirectory}/domains/{$domainName}/public_html";

        $this->execute(
            'sudo -n mkdir -p ' .
            escapeshellarg($websiteDirectory)
        );

        $this->execute(
            'sudo -n chown -R ' .
            escapeshellarg("{$username}:{$username}") .
            ' ' .
            escapeshellarg($homeDirectory)
        );
    }

    /**
     * Configure Apache and request an SSL certificate.
     *
     * DNS must already point to this VPS.
     */
    public function createSSLCertificate(
        string $domainName,
        int $hostingId
    ): void {
        $domainName = $this->validateDomain($domainName);

        $username = $this->linuxUsername($hostingId);

        $documentRoot =
            "/home/{$username}/domains/{$domainName}/public_html";

        $this->prepareWebsite($domainName, $hostingId);

        $apacheConfig = <<<APACHE
                <VirtualHost *:80>
                    ServerName {$domainName}
                    ServerAlias www.{$domainName}

                    DocumentRoot {$documentRoot}

                    <Directory {$documentRoot}>
                        Options FollowSymLinks
                        AllowOverride All
                        Require all granted
                    </Directory>

                    ErrorLog \${APACHE_LOG_DIR}/{$domainName}_error.log
                    CustomLog \${APACHE_LOG_DIR}/{$domainName}_access.log combined
                </VirtualHost>
                APACHE;

        $configPath =
            "/etc/apache2/sites-available/{$domainName}.conf";

        $this->execute(
            'printf %s ' .
            escapeshellarg($apacheConfig) .
            ' | sudo -n tee ' .
            escapeshellarg($configPath) .
            ' > /dev/null'
        );

        $this->execute(
            'sudo -n a2ensite ' .
            escapeshellarg("{$domainName}.conf")
        );

        $this->execute('sudo -n apache2ctl configtest');

        $this->execute('sudo -n systemctl reload apache2');

        $this->execute(
            'sudo -n certbot --apache ' .
            '-d ' . escapeshellarg($domainName) . ' ' .
            '-d ' . escapeshellarg("www.{$domainName}") . ' ' .
            '--non-interactive ' .
            '--agree-tos ' .
            '--email ' . escapeshellarg('contact@lubodev.com') . ' ' .
            '--redirect'
        );

        $this->execute('sudo -n apache2ctl configtest');

        $this->execute('sudo -n systemctl reload apache2');
    }

    /**
     * Check whether the domain and www subdomain
     * resolve to this VPS.
     *
     * Assumes vps.host contains the public IPv4 address.
     */
    public function isDomainDnsReady(string $domainName): bool
    {
        $domainName = $this->validateDomain($domainName);

        $serverIp = $this->vps->host;

        if (!filter_var($serverIp, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            throw new RuntimeException(
                'VPS host must be a public IPv4 address for this DNS check.'
            );
        }

        $domainResult = $this->execute(
            'dig @1.1.1.1 +short ' .
            escapeshellarg($domainName) .
            ' A'
        );

        $wwwResult = $this->execute(
            'dig @1.1.1.1 +short ' .
            escapeshellarg("www.{$domainName}") .
            ' A'
        );

        $domainIps = preg_split(
            '/\s+/',
            trim($domainResult),
            -1,
            PREG_SPLIT_NO_EMPTY
        );

        $wwwIps = preg_split(
            '/\s+/',
            trim($wwwResult),
            -1,
            PREG_SPLIT_NO_EMPTY
        );

        return in_array($serverIp, $domainIps, true)
            && in_array($serverIp, $wwwIps, true);
    }

    /**
     * Get the file manager structure from the server.
     *
     * Only relative paths inside the provided root are accepted.
     */
    public function getFileManager(
        string $rootPath,
        ?string $path = null
    ): array {
        $rootPath = rtrim($rootPath, '/');

        if (
            $rootPath === '' ||
            !str_starts_with($rootPath, '/home/')
        ) {
            throw new RuntimeException('Invalid file manager root.');
        }

        $currentPath = $path;
        $fileContent = null;

        $rootRealPath = trim(
            $this->execute(
                'realpath -e -- ' . escapeshellarg($rootPath)
            )
        );

        if ($currentPath !== null && $currentPath !== '') {
            if (
                str_starts_with($currentPath, '/') ||
                in_array('..', explode('/', $currentPath), true)
            ) {
                abort(403);
            }

            $fullPath = $rootPath . '/' . $currentPath;

            $resolvedPath = trim(
                $this->execute(
                    'realpath -e -- ' . escapeshellarg($fullPath)
                )
            );

            if (
                $resolvedPath !== $rootRealPath &&
                !str_starts_with(
                    $resolvedPath,
                    $rootRealPath . '/'
                )
            ) {
                abort(403);
            }

            $fileContent = $this->execute(
                'cat -- ' . escapeshellarg($resolvedPath)
            );
        }

        $output = $this->execute(
            'find ' .
            escapeshellarg($rootPath) .
            ' -mindepth 1 -printf ' .
            escapeshellarg("%p|%y\n")
        );

        $lines = array_filter(
            explode("\n", trim($output))
        );

        $flatItems = [];

        foreach ($lines as $line) {
            $parts = explode('|', $line, 2);

            if (count($parts) !== 2) {
                continue;
            }

            [$itemPath, $type] = $parts;

            $relativePath = ltrim(
                substr($itemPath, strlen($rootPath)),
                '/'
            );

            $isDirectory = $type === 'd';

            $flatItems[] = [
                'name' => basename($itemPath),
                'path' => $itemPath,
                'relative_path' => $relativePath,
                'type' => $isDirectory ? 'directory' : 'file',
                'is_open' => $isDirectory
                    && $currentPath !== null
                    && str_starts_with(
                        $currentPath,
                        $relativePath . '/'
                    ),
                'is_active' => !$isDirectory
                    && $currentPath === $relativePath,
            ];
        }

        $buildTree = function ($parentPath) use (
            &$buildTree,
            $flatItems
        ) {
            $items = [];

            foreach ($flatItems as $item) {
                if (dirname($item['path']) !== $parentPath) {
                    continue;
                }

                if ($item['type'] === 'directory') {
                    $item['children'] = $buildTree(
                        $item['path']
                    );
                }

                $items[] = $item;
            }

            return $items;
        };

        return [
            'files' => $buildTree($rootPath),
            'fileContent' => $fileContent,
            'currentPath' => $currentPath,
        ];
    }
}
