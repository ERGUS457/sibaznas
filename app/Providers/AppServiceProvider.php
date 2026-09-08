<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
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
        if (config('app.env') === 'production' || isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL']) || getenv('VERCEL')) {
            URL::forceScheme('https');
        }

        view()->composer('*', function ($view) {
            try {
                if (\Illuminate\Support\Facades\Schema::hasTable('upz_profiles')) {
                    $orgService = app(\App\Services\OrganizationContextService::class);
                    $view->with('currentOrganization', $orgService->getActiveOrganization());
                    $view->with('availableOrganizations', $orgService->getAllOrganizations());
                }
            } catch (\Throwable $e) {
                // Ignore during early bootstrap or migrations
            }
        });
    }
}
