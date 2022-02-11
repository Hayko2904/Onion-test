<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Onion\Repository\ControllerServiceInterface;
use Onion\Repository\InertiaControllerService;
use Onion\Services\ServiceInterface;
use Onion\UI\Services\InertiaService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ControllerServiceInterface::class, InertiaControllerService::class);
        $this->app->bind(ServiceInterface::class, InertiaService::class);
    }
}
