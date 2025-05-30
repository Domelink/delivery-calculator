<?php

namespace App\Providers;

use App\Services\DeliveryFeeService;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\DeliveryFeeServiceInterface;

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
        $this->app->bind(DeliveryFeeServiceInterface::class, DeliveryFeeService::class);
    }
}
