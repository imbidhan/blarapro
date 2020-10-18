<?php

namespace App\Modules\Config\Providers;

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
        $this->loadTranslationsFrom(module_path('config', 'Resources/Lang', 'app'), 'config');
        $this->loadViewsFrom(module_path('config', 'Resources/Views', 'app'), 'config');
        $this->loadMigrationsFrom(module_path('config', 'Database/Migrations', 'app'));
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('config', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('config', 'Database/Factories', 'app'));
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
