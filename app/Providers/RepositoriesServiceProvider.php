<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(
            'App\Contracts\RoleInterface',
            'App\Repositories\RoleRepository', 
            
        );
        $this->app->bind(
            'App\Contracts\ModuleInterface',
            'App\Repositories\ModuleRepository'
            
        );
    }
}
