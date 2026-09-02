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

    $ssh = new SSH2('186.240.157.236');

    if (!$ssh->login(env('VPS_USERNAME'), env('VPS_PASSWORD'))) {
        dd('SSH login failed');
    }

    // Get the directories inside /home
    $output = $ssh->exec('ls /home');


    // Convert the output into a PHP array
    $users = array_filter(
        explode("\n", trim($output))
    );

    dd($users);

    foreach ($users as $user) {
        dd($user);
    }
});
