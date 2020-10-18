<?php

namespace App\Modules\Deposit\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(module_path('deposit', 'Resources/Lang', 'app'), 'deposit');
        $this->loadViewsFrom(module_path('deposit', 'Resources/Views', 'app'), 'deposit');
        $this->loadMigrationsFrom(module_path('deposit', 'Database/Migrations', 'app'));
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('deposit', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('deposit', 'Database/Factories', 'app'));
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
