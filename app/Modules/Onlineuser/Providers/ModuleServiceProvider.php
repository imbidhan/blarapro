<?php

namespace App\Modules\Onlineuser\Providers;

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
        $this->loadTranslationsFrom(module_path('onlineuser', 'Resources/Lang', 'app'), 'onlineuser');
        $this->loadViewsFrom(module_path('onlineuser', 'Resources/Views', 'app'), 'onlineuser');
        $this->loadMigrationsFrom(module_path('onlineuser', 'Database/Migrations', 'app'));
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('onlineuser', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('onlineuser', 'Database/Factories', 'app'));
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
