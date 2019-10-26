<?php

namespace CleanCodeStudio\MakeFacades;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

// Provider Automatically Registered To Application When CleanCodeStudio\MakeFacadeServiceProvider.php Is Registered
class AutoAliasFacadesServiceProvider extends BaseServiceProvider
{
    // Helpful Docs: See Simple Bindings Section
    // https://laravel.com/docs/6.x/providers

    // MUST REGISTER Service Related To Facade Here To Automatically Register Its Alias
    public $bindings = [
        // 'Example' => App\Facades\Example\Example::class, 
        // Automatically Registers Alias: 'Example' => App\Facades\Example\ExampleFacade::class
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Only Bind Facade Services Via The $bindings property to automatically add aliases!!!

        // Auto register facades for auto generated facade services registered in bindings. 
        $this->registerFacadeAliases();
    }

    /**
     * Register Facade Aliases
     */
    protected function registerFacadeAliases()
    {
        collect($this->bindings)
            ->filter(function ($service) {
                return class_exists("{$service}Facade");
            })
            ->each(function ($service, $alias) {
                AliasLoader::getInstance()->alias($alias, "{$service}Facade");
            });
    }

    public function boot()
    {
        // boot
    }

}
