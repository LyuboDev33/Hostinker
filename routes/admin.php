<?php

use App\Http\Controllers\Admin\BlogAdminController;
use App\Http\Controllers\Admin\HostingAdminController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'super_admin'])->group(function () {

    Route::prefix('/admin')->group(function () {

        /** Hosting plans */
        Route::prefix('/hosting')->group(function() {
            Route::get('/', [HostingAdminController::class, 'index'])->name('super_admin.hosting.index');
            Route::post('/', [HostingAdminController::class, 'store'])->name('super_admin.hosting.store');
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
