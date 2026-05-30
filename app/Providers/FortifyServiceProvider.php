<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
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
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);

        $this->rateLimiters();

        $this->handleViews();

        $this->handleCustomMails();
    }

    private function handleViews(): void
    {
        Fortify::loginView(function () {
            return view('pages.auth.login');
        });

        Fortify::requestPasswordResetLinkView(function () {
            return view('pages.auth.forgot-password');
        });

        Fortify::resetPasswordView(function (Request $request) {
            return view('pages.auth.reset-password', ['request' => $request]);
        });

        RedirectIfAuthenticated::redirectUsing(function () {
            return route('dashboard');
        });
    }

    public function rateLimiters(): void
    {
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }

    public function handleCustomMails(): void
    {
        // SOURCE : https://stackoverflow.com/questions/66162320/fortify-how-to-customise-verification-password-reset-emails
        ResetPassword::toMailUsing(function($user, string $token) {
            return (new MailMessage)
                ->subject('Réinitialisation de votre mot de passe')
                ->view('mails.auth.reset-password', [
                    'user' => $user,
                    'url' => route('password.reset', ['token' => $token])
                ]);
        });
    }
}
