<?php

namespace CleanCodeStudio\MakeFacades;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Auto Register AutoAliasFacadesServiceProvider
        $this->app->register(Providers\AutoAliasFacadesServiceProvider::class);        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // publish config
        $this->publishes([
            __DIR__.'/config/make-facades.php' => config_path('make-facades.php')
        ], 'config');

        // publish auto alias facades service provider
        $this->publishes([
            __DIR__.'/providers/AutoAliasFacadesServiceProvider.php' => app_path('providers/AutoAliasFacadesServiceProvider.php')
        ], 'provider');

        // Register Aliases
        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\FacadeMakeGenerator::class
            ]);
        }
    }
}
