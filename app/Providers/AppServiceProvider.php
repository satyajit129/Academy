<?php

namespace App\Providers;

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
        
        $this->loadRoutesFrom(base_path('routes/backend.php'));
        $this->loadRoutesFrom(base_path('routes/custom_template_route.php'));
    }
}