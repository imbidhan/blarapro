<?php

namespace App\Modules\Accesslevel\Providers;

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
        $this->loadTranslationsFrom(module_path('accesslevel', 'Resources/Lang', 'app'), 'accesslevel');
        $this->loadViewsFrom(module_path('accesslevel', 'Resources/Views', 'app'), 'accesslevel');
        $this->loadMigrationsFrom(module_path('accesslevel', 'Database/Migrations', 'app'));
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('accesslevel', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('accesslevel', 'Database/Factories', 'app'));
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
