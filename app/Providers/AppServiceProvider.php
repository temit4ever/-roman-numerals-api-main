<?php

namespace App\Providers;

use App\Services\Contracts\IntegerConverterService;
use App\Services\IntegerConverterInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IntegerConverterInterface::class, IntegerConverterService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
