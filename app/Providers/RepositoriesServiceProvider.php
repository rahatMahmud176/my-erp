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
        $this->app->bind(
            'App\Contracts\BrandInterface',
            'App\Repositories\BrandRepository' 
        );
        $this->app->bind(
            'App\Contracts\ColorInterface',
            'App\Repositories\ColorRepository' 
        );
        $this->app->bind(
            'App\Contracts\SizeInterface',
            'App\Repositories\SizeRepository' 
        );
        $this->app->bind(
            'App\Contracts\CountryVariantInterface',
            'App\Repositories\CountryVariantRepository' 
        );
        $this->app->bind(
            'App\Contracts\UnitInterface',
            'App\Repositories\UnitRepository' 
        );
        $this->app->bind(
            'App\Contracts\SubUnitInterface',
            'App\Repositories\SubUnitRepository' 
        );
        $this->app->bind(
            'App\Contracts\ItemInterface',
            'App\Repositories\ItemRepository' 
        );
        $this->app->bind(
            'App\Contracts\BranchInterface',
            'App\Repositories\BranchRepository' 
        );
        $this->app->bind(
            'App\Contracts\SupplierInterface',
            'App\Repositories\SupplierRepository' 
        );
        $this->app->bind(
            'App\Contracts\StockInterface',
            'App\Repositories\StockRepository' 
        );
        $this->app->bind(
            'App\Contracts\SettingInterface',
            'App\Repositories\SettingRepository' 
        );
        $this->app->bind(
            'App\Contracts\AccountInterface',
            'App\Repositories\AccountRepository' 
        );
        $this->app->bind(
            'App\Contracts\ChallanInterface',
            'App\Repositories\ChallanRepository' 
        );
        $this->app->bind(
            'App\Contracts\TransitionInterface',
            'App\Repositories\TransitionRepository' 
        );
        $this->app->bind(
            'App\Contracts\SupplierTransitionInterface',
            'App\Repositories\SupplierTransitionRepository' 
        );
        $this->app->bind(
            'App\Contracts\CustomerInterface',
            'App\Repositories\CustomerRepository' 
        );
        $this->app->bind(
            'App\Contracts\InvoiceInterface',
            'App\Repositories\InvoiceRepository' 
        );
        


    }
}
