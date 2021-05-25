<?php

namespace CleanCodeStudio\MakeFacades;

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
        // register config for use within service provider boot method
        $this->mergeConfigFrom(__DIR__.'/config/make-facades.php', 'make-facades');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // publish config for end user customization 
        $this->publishes([
            __DIR__.'/config/make-facades.php' => config_path('make-facades.php')
        ], 'config');

        // publish auto alias facades service provider

        $this->publishes([
            __DIR__.'/providers/AliasFacadesServiceProvider.php' => app_path(config('make-facades.providers_path').'/AliasFacadesServiceProvider.php')
        ], 'provider');

        // Register Aliases
        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\FacadeMakeGenerator::class
            ]);
        }
    }
}
