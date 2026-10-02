<?php

namespace App\Services;

use phpseclib4\Net\SSH2;

class SSHService
{
    private ?SSH2 $ssh = null;

    /**
     * Get the SSH connection.
     *
     * @return SSH2
     */
    private function ssh(): SSH2
    {

        $this->ssh = new SSH2(env('VPS_HOST'));

        if (!$this->ssh->login(
            env('VPS_USERNAME'),
            env('VPS_PASSWORD')
        )) {
            abort(500, 'SSH login failed.');
        }

        return $this->ssh;
    }

    /**
     * Create the Linux user if the home directory does not already exist.
     *
     * @param int $userId
     * @return void
     */
    public function createLinuxUser(int $userId): void
    {
        $ssh = $this->ssh();

        $username = "server_user{$userId}";
        $homeDirectory = "/home/{$username}";

        $directoryExists = trim(
            $ssh->exec(
                "if [ -d " . escapeshellarg($homeDirectory) . " ]; then echo 'exists'; fi"
            )
        );

        if ($directoryExists === 'exists') {
            return;
        }

        $output = $ssh->exec(
            "sudo useradd -m -d {$homeDirectory} -s /usr/sbin/nologin {$username}"
        );

        $exitStatus = $ssh->getExitStatus();

        if ($exitStatus !== 0) {
            abort(
                500,
                "Failed to create Linux user {$username}: {$output}"
            );
        }
    }

    /**
     * Prepare the server user and domain directory.
     *
     * @param string $domainName
     * @param int $userId
     * @return void
     */
    public function prepareWebsite(string $domainName, int $userId): void
    {
        $ssh = $this->ssh();

        $ssh->exec("sudo useradd -m -s /usr/sbin/nologin server_user" . $userId);

        $ssh->exec(
            "mkdir -p /home/server_user{$userId}/domains/{$domainName}/public_html"
        );

        $ssh->exec(
            "sudo chown -R server_user{$userId}:server_user{$userId} /home/server_user{$userId}"
        );
    }

    /**
     * Configure the server after a domain is paid.
     *
     * @param string $domainName
     * @param int $userId
     * @return void
     */
    public function createSSLCertificate(string $domainName, int $userId): void
    {
        $ssh = $this->ssh();

        $apacheConfig = <<<APACHE
            <VirtualHost *:80>
                ServerName {$domainName}
                ServerAlias www.{$domainName}

                DocumentRoot /home/server_user{$userId}/domains/{$domainName}/public_html

                <Directory /home/server_user{$userId}/domains/{$domainName}/public_html>
                    Options Indexes FollowSymLinks
                    AllowOverride All
                    Require all granted
                </Directory>

                ErrorLog \${APACHE_LOG_DIR}/{$domainName}_error.log
                CustomLog \${APACHE_LOG_DIR}/{$domainName}_access.log combined
            </VirtualHost>
            APACHE;

        $escapedConfig = escapeshellarg($apacheConfig);

        $ssh->exec(
            "echo {$escapedConfig} | sudo tee /etc/apache2/sites-available/{$domainName}.conf > /dev/null"
        );

        $ssh->exec(
            "echo {$escapedConfig} | sudo tee /etc/apache2/sites-enabled/{$domainName}.conf > /dev/null"
        );

        $isSyntaxCorrect = trim(
            $ssh->exec('apache2ctl configtest')
        );

        if ($isSyntaxCorrect !== 'Syntax OK') {
            abort(
                500,
                'Apache configuration syntax error: ' . $isSyntaxCorrect
            );
        }

        $ssh->exec(
            "sudo certbot --apache -d {$domainName} -d www.{$domainName} --non-interactive --agree-tos --email contact@lubodev.com --redirect"
        );

        $isSyntaxCorrect = trim(
            $ssh->exec('apache2ctl configtest')
        );

        if ($isSyntaxCorrect !== 'Syntax OK') {
            abort(
                500,
                'Apache configuration syntax error: ' . $isSyntaxCorrect
            );
        }

        $ssh->exec('systemclt restart apache2.service');
    }

    /**
     * Check if the domain DNS records point to the VPS.
     *
     * @param string $domainName
     * @return bool
     */
    public function isDomainDnsReady(string $domainName): bool
    {
        $ssh = $this->ssh();

        $serverIp = env('VPS_HOST');

        $domainResult = trim(
            $ssh->exec(
                "dig @1.1.1.1 +short {$domainName} A"
            )
        );

        $wwwResult = trim(
            $ssh->exec(
                "dig @1.1.1.1 +short www.{$domainName} A"
            )
        );

        $domainIps = preg_split('/\s+/', $domainResult);
        $wwwIps = preg_split('/\s+/', $wwwResult);

        return in_array($serverIp, $domainIps, true)
            && in_array($serverIp, $wwwIps, true);
    }

    /**
     * Get the file manager structure from the server.
     *
     * @param string $rootPath
     * @param string|null $path
     * @return array
     */
    public function getFileManager(string $rootPath, ?string $path = null): array
    {
        $ssh = $this->ssh();

        $currentPath = $path;
        $fileContent = null;

        if ($currentPath) {
            if (in_array('..', explode('/', $currentPath), true)) {
                abort(403);
            }

            $fullPath = $rootPath . '/' . $currentPath;

            $fileContent = $ssh->exec(
                'cat ' . escapeshellarg($fullPath)
            );
        }

        $output = $ssh->exec(
            'find '
                . escapeshellarg($rootPath)
                . ' -mindepth 1 -printf "%p|%y\n"'
        );

        $lines = array_filter(
            explode("\n", trim($output))
        );

        $flatItems = [];

        foreach ($lines as $line) {
            [$itemPath, $type] = explode('|', $line, 2);

            $relativePath = ltrim(
                str_replace($rootPath, '', $itemPath),
                '/'
            );

            $isDirectory = $type === 'd';

            $flatItems[] = [
                'name' => basename($itemPath),
                'path' => $itemPath,
                'relative_path' => $relativePath,
                'type' => $isDirectory ? 'directory' : 'file',
                'is_open' => $isDirectory
                    && $currentPath
                    && str_starts_with(
                        $currentPath,
                        $relativePath . '/'
                    ),
                'is_active' => !$isDirectory
                    && $currentPath === $relativePath,
            ];
        }

        $buildTree = function ($parentPath) use (&$buildTree, $flatItems) {
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
