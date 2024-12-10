<?php

namespace App\Providers;

use App\Models\Admin;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\CreateNewAdmin;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;

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
        Fortify::createUsersUsing(CreateNewAdmin::class);

        Fortify::registerView(function() {
            return view('admin.register');
        });

        Fortify::loginView(function () {
            return view('admin.login');
        });

        Fortify::authenticateUsing(function (\Laravel\Fortify\Http\Requests\LoginRequest $request) {
            $admin = Admin::where('email', $request->email)->first();

            if ($admin && Hash::check($request->password, $admin->password)) {
                Auth::guard('admin')->login($admin);
                return $admin; // 認証成功
            }

            return null; // 認証失敗
        });

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(10)->by($email . $request->ip());
        });
    }
}
