<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Onion\Repository\ControllerServiceInterface;
use Onion\Repository\InertiaControllerService;
use Onion\Services\InertiaService;
use Onion\Services\ServiceInterface;
use Onion\UI\Controllers\ProductController;

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
        $this->app->when(ProductController::class)
            ->needs(ControllerServiceInterface::class)
            ->give(InertiaControllerService::class);
        $this->app->bind(ServiceInterface::class, InertiaService::class);
    }
}
