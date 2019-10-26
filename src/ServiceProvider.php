<?php

namespace CleanCodeStudio\MakeFacades;

use Commands\FacadeMakeGenerator;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class ServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Auto Register AutoAliasFacadesServiceProvider
        $this->app->register(AutoAliasFacadesServiceProvider::class);        
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
            __DIR__.'/../config/make-facades.php' => config_path('make-facades.php')
        ], 'config');

        // publish auto alias facades service provider
        $this->publishes([
            __DIR__.'/../providers/AutoAliasFacadesServiceProvider.php' => app_path('providers/AutoAliasFacadesServiceProvider.php')
        ], 'provider');

        // Register Aliases
        if ($this->app->runningInConsole()) {
            $this->commands([FacadeMakeGenerator::class]);
        }
    }
}
