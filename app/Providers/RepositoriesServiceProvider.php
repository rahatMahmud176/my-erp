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
        $this->app->bind(
            'App\Contracts\UserInterface',
            'App\Repositories\UserRepository' 
        );
        $this->app->bind(
            'App\Contracts\CategoryInterface',
            'App\Repositories\CategoryRepository' 
        );
        $this->app->bind(
            'App\Contracts\subCategoryInterface',
            'App\Repositories\SubCategoryRepository' 
        );
    }
}
