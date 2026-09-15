<?php

use App\Http\Controllers\Admin\BlogAdminController;
use App\Http\Controllers\Admin\WebhookController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'super_admin'])->group(function () {

    Route::prefix('/admin')->group(function () {

        /** Webhook subscription */
        Route::prefix('/webhooks')->group(function () {

            Route::get('/domain-expiry', [WebhookController::class, 'subscribeDomainExpiry'])->name('webhook.domain.expiry');
            Route::get('/retrieve-webhooks', [WebhookController::class, 'retrieveAllWebhookSubscriptions']);

            Route::get('');

        });


        /** Blog Routing */
        Route::prefix('/blog')->group(function () {
            Route::get('/', [BlogAdminController::class, 'index'])->name('super_admin.blog.index');
            Route::get('/create-view', [BlogAdminController::class, 'createBlogView'])->name('super_admin.blog.create-view');
            Route::post('/create', [BlogAdminController::class, 'create'])->name('super_admin.blog.create');
            Route::patch('/update/{blog}', [BlogAdminController::class, 'update'])->name('super_admin.blog.update');
            Route::delete('/delete/{blog}', [BlogAdminController::class, 'delete'])->name('super_admin.blog.delete');
            Route::get('/{slug}', [BlogAdminController::class, 'show'])->name('super_admin.blog.show');
        });


    });
});
