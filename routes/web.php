<?php

use App\Http\Controllers\Backend\BackendDomainController;
use App\Http\Controllers\Backend\BackendWebsitesController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/',        [FrontEndController::class, 'welcome'])->name('welcome');
Route::get('/contact', [FrontEndController::class, 'contact'])->name('contact');
Route::get('/about',   [FrontEndController::class, 'about'])->name('about');
Route::get('/pricing', [FrontEndController::class, 'pricing'])->name('pricing');

Route::get('/test-2', [BackendWebsitesController::class,  'afterDomainPaid']);

# Domain routing
Route::prefix('/domain')->group(function () {
    Route::get('/', [DomainController::class, 'domain'])->name('domain');
    Route::post('/check-availability', [DomainController::class, 'checkAvailability'])->name('domain.check.availability');
    Route::post('/add-domain-to-cart/{domainName}', [DomainController::class, 'addDomainToCart'])->name('domain.add.to.cart');
    Route::post('/register-domain', [DomainController::class, 'registerDomain'])->name('domain.register');


    Route::get('/cart', [DomainController::class, 'cart'])->name('domain.cart');
    Route::delete('/cart/destroy', [DomainController::class, 'cartDestroy'])->name('domain.cart.destroy');
    Route::get('/tlds', [DomainController::class, 'getTldPricing']);
    Route::get('/list', [DomainController::class, 'listAllDomains']);
    Route::get('/payment/success', [DomainController::class, 'successfullPayment'])->name('successPayment');
    Route::get('/payment/fail', [DomainController::class, 'failPayment'])->name('failPayment');
    Route::get('/payment/complete', [DomainController::class, 'completeDomainPayment'])->name('completeDomainPayment');
});



Route::get('/dashboard', function () {
    return view('Backend.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::prefix('/domains')->group(function () {
        Route::get('/', [BackendDomainController::class, 'index'])->name('backend.domain.index');
        Route::patch('/update/{domain_name}', [BackendDomainController::class, 'update'])->name('backend.domain.update');

        Route::get('/nameservers/{domain}', [BackendDomainController::class, 'retrieveNameservers'])->name('backend.domain.nameservers');
        Route::put('/nameservers/update/{domain}', [BackendDomainController::class, 'updateNameservers'])->name('backend.domain.update.nameservers');
        Route::get('/dns-records/{domain}', [BackendDomainController::class, 'retrieveDNSrecords'])->name('backend.domain.dns-records');
        Route::post('/dns-records/{domain}/create', [BackendDomainController::class, 'createDNSrecord'])->name('backend.create.dns-record');
    });

    Route::prefix('/websites')->group(function () {
        Route::get('/', [BackendWebsitesController::class, 'index'])->name('backend.websites.index');
        Route::get('/{website}', [BackendWebsitesController::class, 'show'])->name('backend.websites.show');
        Route::get('/files/{domainName}/{path?}', [BackendWebsitesController::class, 'showFileManager'])
            ->where('path', '.*')
            ->name('backend.files.show');
    });


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/api.php';
require __DIR__ . '/admin.php';
