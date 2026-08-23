<?php

use App\Http\Controllers\DomainController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/',        [FrontEndController::class, 'welcome'])->name('welcome');
Route::get('/contact', [FrontEndController::class, 'contact'])->name('contact');
Route::get('/about',   [FrontEndController::class, 'about'])->name('about');
Route::get('/pricing', [FrontEndController::class, 'pricing'])->name('pricing');

Route::prefix('/domain')->group(function () {
    Route::get('/', [DomainController::class, 'domain'])->name('domain');
    Route::post('/check-availability', [DomainController::class, 'checkAvailability'])->name('domain.check.availability');

    Route::get('/transfer', [DomainController::class, 'transfer'])->name('domain.transfer');
    Route::get('/migrate',  [DomainController::class, 'migrate'])->name('domain.migrate');

});


Route::get('/dashboard', function () {
    return view('Backend.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
