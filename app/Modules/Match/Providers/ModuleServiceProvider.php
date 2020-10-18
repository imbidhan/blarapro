<?php

namespace App\Modules\Match\Providers;

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
        $this->loadTranslationsFrom(module_path('match', 'Resources/Lang', 'app'), 'match');
        $this->loadViewsFrom(module_path('match', 'Resources/Views', 'app'), 'match');
        $this->loadMigrationsFrom(module_path('match', 'Database/Migrations', 'app'));
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('match', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('match', 'Database/Factories', 'app'));
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
