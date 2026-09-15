<?php

use App\Http\Controllers\DomainController;
use Illuminate\Support\Facades\Route;
use phpseclib4\Net\SSH2;

Route::middleware(['auth', 'super_admin'])->group(function () {

    Route::prefix('/api/domain')->group(function () {
        Route::get('/listing', [DomainController::class, 'listAllDomains']);
        Route::get('/register-domain/{domain_name}', [DomainController::class, 'registerDomain'])->name('register.domain');
    });
});



Route::get('/test', function () {

    $ssh = new SSH2('72.61.179.145');

    if (!$ssh->login(env('VPS_USERNAME'), env('VPS_PASSWORD'))) {
        dd('SSH login failed');
    }

    $rootPath = '/home/test_user1/domains/hosthinker.info/public_html';

    function getFilesTree($ssh, $path)
    {
        $output = $ssh->exec(
            'find ' . escapeshellarg($path) . ' -mindepth 1 -maxdepth 1'
        );

        $files = array_filter(
            explode("\n", trim($output))
        );

        $names = [];

        foreach ($files as $file) {
            $names[] = basename($file);
        }

        dd($names);

        $lines = array_filter(explode("\n", trim($output)));

        $items = [];

        foreach ($lines as $line) {

            [$name, $type] = explode('|', $line, 2);

            $fullPath = $path . '/' . $name;

            $item = [
                'name' => $name,
                'type' => $type === 'd' ? 'directory' : 'file',
            ];

            // If directory → recursively get its contents
            if ($type === 'd') {
                $item['children'] = getFilesTree($ssh, $fullPath);
            }

            $items[] = $item;
        }

        return $items;
    }

    $files = getFilesTree($ssh, $rootPath);

    dd($files);
});
