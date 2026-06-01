<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // $this->loadMigrationsFrom(base_path('config/database/migrations'));
    }

    public function boot(): void
    {
        Carbon::setLocale('id');

        if (app()->environment('production')) {
            URL::forceScheme('https');
            Paginator::useBootstrapFive();
        }

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip());
        });

        RateLimiter::for('bid', function (Request $request) {
            return Limit::perMinute(10)->by($request->user('masyarakat')?->id_user ?? $request->ip());
        });

        RateLimiter::for('export', function (Request $request) {
            return Limit::perMinute(3)->by($request->user()?->id ?? $request->ip());
        });
    }
}
