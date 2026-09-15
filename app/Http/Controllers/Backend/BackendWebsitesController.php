<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\UserHosting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpseclib4\Net\SSH2;

class BackendWebsitesController extends Controller
{
    /** Return all the domains */
    public function index()
    {
        $websites = Domain::where('user_id', Auth::id())->get();

        return view('Backend.websites.Index', [
            'websites' => $websites
        ]);
    }

    /**
     *
     * @param string $domainName
     */
    public function show(string $domainName)
    {
        $domain = Domain::where('domain_name', $domainName)->first();

        return view('Backend.websites.show', [
            'website' => $domain
        ]);
    }

    public function afterDomainPaid()
    {
        $ssh = new SSH2('72.61.179.145');

        if (!$ssh->login(env('VPS_USERNAME'), env('VPS_PASSWORD'))) {
            abort(500, 'SSH login failed.');
        }

        $var = 4;
        $domainName = 'infinity21.eu';

        $ssh->exec("sudo useradd -m -s /usr/sbin/nologin user_test" .  $var);

        $ssh->exec('mkdir -p /home/user_test4/domains/infinity21.eu/public_html');
        $test = $ssh->exec("sudo chown -R user_test{$var}:user_test{$var} /home/user_test{$var}");


        $apacheConfig = <<<APACHE
            <VirtualHost *:80>
                ServerName {$domainName}
                ServerAlias www.{$domainName}

                DocumentRoot /home/user_test{$var}/domains/{$domainName}/public_html

                <Directory /home/user_test{$var}/domains/{$domainName}/public_html>
                    Options Indexes FollowSymLinks
                    AllowOverride All
                    Require all granted
                </Directory>

                ErrorLog \${APACHE_LOG_DIR}/{$domainName}_error.log
                CustomLog \${APACHE_LOG_DIR}/{$domainName}_access.log combined
            </VirtualHost>
            APACHE;

        $escapedConfig = escapeshellarg($apacheConfig);

        $test = $ssh->exec("echo {$escapedConfig} | sudo tee /etc/apache2/sites-available/{$domainName}.conf > /dev/null");

        $test = $ssh->exec("echo {$escapedConfig} | sudo tee /etc/apache2/sites-enabled/{$domainName}.conf > /dev/null");

        $isSyntaxCorrect = trim($ssh->exec('apache2ctl configtest'));

        if ($isSyntaxCorrect !== 'Syntax OK') {
            abort(500, 'Apache configuration syntax error: ' . $isSyntaxCorrect);
        }

        $sslResult = $ssh->exec(
            "sudo certbot --apache -d {$domainName} -d www.{$domainName} --non-interactive --agree-tos --email contact@lubodev.com --redirect"
        );

        $isSyntaxCorrect = trim($ssh->exec('apache2ctl configtest'));

        if ($isSyntaxCorrect !== 'Syntax OK') {
            abort(500, 'Apache configuration syntax error: ' . $isSyntaxCorrect);
        }

        $ssh->exec('systemclt restart apache2.service');

        dd($sslResult);
    }

    public function showFileManager(string $domainName, ?string $path = null)
    {
        $domain = Domain::where('domain_name', $domainName)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $hosting = UserHosting::where('user_id', Auth::id())
            ->where('is_active', true)
            ->firstOrFail();

        $rootPath = '/home/' . $hosting->linux_user . '/domains/' . $domain->domain_name . '/public_html';

        $ssh = new SSH2('72.61.179.145');

        if (!$ssh->login(env('VPS_USERNAME'), env('VPS_PASSWORD'))) {
            abort(500, 'SSH login failed.');
        }

        $currentPath = $path;
        $fileContent = null;

        if ($currentPath) {
            if (in_array('..', explode('/', $currentPath), true)) {
                abort(403);
            }

            $fullPath = $rootPath . '/' . $currentPath;
            $fileContent = $ssh->exec('cat ' . escapeshellarg($fullPath));
        }

        $output = $ssh->exec('find ' . escapeshellarg($rootPath) . ' -mindepth 1 -printf "%p|%y\n"');
        $lines = array_filter(explode("\n", trim($output)));

        $flatItems = [];

        foreach ($lines as $line) {
            [$itemPath, $type] = explode('|', $line, 2);

            $relativePath = ltrim(str_replace($rootPath, '', $itemPath), '/');

            $isDirectory = $type === 'd';

            $flatItems[] = [
                'name' => basename($itemPath),
                'path' => $itemPath,
                'relative_path' => $relativePath,
                'type' => $isDirectory ? 'directory' : 'file',
                'is_open' => $isDirectory
                    && $currentPath
                    && str_starts_with($currentPath, $relativePath . '/'),
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
                    $item['children'] = $buildTree($item['path']);
                }

                $items[] = $item;
            }

            return $items;
        };

        $files = $buildTree($rootPath);

        return view('Backend.websites.files', [
            'domain' => $domain,
            'files' => $files,
            'rootPath' => $rootPath,
            'fileContent' => $fileContent,
            'currentPath' => $currentPath,
        ]);
    }
}
