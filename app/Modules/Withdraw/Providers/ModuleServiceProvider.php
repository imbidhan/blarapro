<?php

namespace App\Modules\Withdraw\Providers;

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
        $this->loadTranslationsFrom(module_path('withdraw', 'Resources/Lang', 'app'), 'withdraw');
        $this->loadViewsFrom(module_path('withdraw', 'Resources/Views', 'app'), 'withdraw');
        $this->loadMigrationsFrom(module_path('withdraw', 'Database/Migrations', 'app'));
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('withdraw', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('withdraw', 'Database/Factories', 'app'));
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
