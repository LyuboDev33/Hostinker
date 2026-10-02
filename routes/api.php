<?php

use App\Http\Controllers\Admin\WebhookController;
use App\Http\Controllers\DomainController;
use Illuminate\Support\Facades\Route;
use phpseclib4\Net\SSH2;

Route::middleware(['auth', 'super_admin'])->group(function () {

            /** Webhook subscription */
        Route::prefix('/webhooks')->group(function () {

            Route::get('/domain-expiry', [WebhookController::class, 'subscribeDomainExpiry'])->name('webhook.domain.expiry');
            Route::get('/retrieve-webhooks', [WebhookController::class, 'retrieveAllWebhookSubscriptions']);

            // Route::get('');

        });

    Route::prefix('/api/domain')->group(function () {
        Route::get('/listing', [DomainController::class, 'listAllDomains']);
        Route::get('/register-domain/{domain_name}', [DomainController::class, 'registerDomain'])->name('register.domain');
    });
});



// Route::get('/test', function () {

//     $ssh = new SSH2('72.61.179.145');

//     if (!$ssh->login(env('VPS_USERNAME'), env('VPS_PASSWORD'))) {
//         dd('SSH login failed');
//     }

//     $command = <<<'BASH'
// mysql -u root -p'ZTqRGZ2Fw82z' -e "
// CREATE DATABASE \`u3_test3\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
// CREATE USER 'u3_test3'@'localhost' IDENTIFIED BY 'Test1234!';
// GRANT ALTER, CREATE VIEW, INDEX, SELECT, DELETE, INSERT,
// SHOW VIEW, ALTER ROUTINE, CREATE ROUTINE, DROP, LOCK TABLES,
// TRIGGER, CREATE TEMPORARY TABLES, EXECUTE, REFERENCES, UPDATE, EVENT ON \`u3_test3\`.* TO 'u3_test3'@'localhost';
// FLUSH PRIVILEGES;
// "
// BASH;

//     $ssh->exec($command);
// });
