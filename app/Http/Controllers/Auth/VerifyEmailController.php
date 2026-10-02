<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\SSHService;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    public function __construct(
        private SSHService $sshService
    ) {
    }

    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(
                route('dashboard', absolute: false) . '?verified=1'
            );
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));

            $this->sshService->createLinuxUser($user->id);
        }

        return redirect()->intended(
            route('dashboard', absolute: false) . '?verified=1'
        );
    }
}
