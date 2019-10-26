<?php

namespace CleanCodeStudio\MakeFacades\Providers;

// Provider Automatically Registered when config.make-facades.auto_alias_facades is set as TRUE
class AliasFacadesServiceProvider extends BaseAliasFacadesServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Set config.make-facades.auto_alias_facades as TRUE to 
        // 1. Automatically bind facade services to service container
        // 2. Automatically register facade aliases
        $this->registerFacadeServiceContainerBindings();
        $this->registerFacadeAliases();
    }

    /**
     * Boot Services
     *
     * @return void
     */
    public function boot()
    {
        // boot
    }

}
