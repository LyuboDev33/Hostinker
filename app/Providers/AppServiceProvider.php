<?php

namespace App\Providers;

use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('isAdmin', $this->isAdmin());
            $view->with('profilePicture', $this->profilePicture());
        });
    }

    /**
     * Determine whether the authenticated user is a super admin.
     *
     * @return bool
     */
    private function isAdmin(): bool
    {
        $user = Auth::user();

        if (! $user) {
            return false;
        }

        return $user->roles()
            ->where('role_name', Role::SUPER_ADMIN)
            ->exists();
    }



    /**
     * Check if user has uploaded a Profile Picture
     * Returns the image src as a string
     *
     * @return string
     */
    private static function profilePicture(): string
    {
        $user = Auth::user();

        if (empty($user->profile_pic)) {
            return asset('/assets/img/avatar-default-image.webp');
        }

        $path = public_path('/assets/img/dashboard/profile_pics/' . $user->profile_pic);

        return file_exists($path)
            ? asset('/assets/img/dashboard/profile_pics/' . $user->profile_pic)
            : asset('/assets/img/avatar-default-image.webp');
    }
}
