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
        $this->app->bind(
            \App\Interfaces\Admin\RoleRepositoryInterface::class,
            \App\Repositories\Admin\RoleRepository::class,

            \App\Interfaces\Admin\ModuleRepositoryInterface::class,
            \App\Repositories\Admin\ModuleRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
