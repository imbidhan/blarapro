<?php

namespace App\Modules\Slide\Providers;

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
        $this->loadTranslationsFrom(module_path('slide', 'Resources/Lang', 'app'), 'slide');
        $this->loadViewsFrom(module_path('slide', 'Resources/Views', 'app'), 'slide');
        $this->loadMigrationsFrom(module_path('slide', 'Database/Migrations', 'app'));
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('slide', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('slide', 'Database/Factories', 'app'));
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
