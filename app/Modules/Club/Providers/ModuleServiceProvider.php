<?php

namespace App\Modules\Club\Providers;

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
        $this->loadTranslationsFrom(module_path('club', 'Resources/Lang', 'app'), 'club');
        $this->loadViewsFrom(module_path('club', 'Resources/Views', 'app'), 'club');
        $this->loadMigrationsFrom(module_path('club', 'Database/Migrations', 'app'));
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('club', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('club', 'Database/Factories', 'app'));
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
