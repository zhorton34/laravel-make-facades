<?php

namespace CleanCodeStudio\MakeFacades\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

// Provider Automatically Registered To Application When CleanCodeStudio\MakeFacadeServiceProvider.php Is Registered
class BaseAliasFacadesServiceProvider extends BaseServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $automatically_bind_and_alias_facades = config('make-facades.auto_alias_facades');

        if ($automatically_bind_and_alias_facades) {
            $this->app->register(AliasFacadesServiceProvider::class);
        }
    }

    /**
     * Register Facade Service Bindings
     */
    protected function registerFacadeServiceContainerBindings()
    {
        $facades = base_path(config('make-facades.path'));
        $directories = glob($facades . '/*' , GLOB_ONLYDIR);

        foreach($directories as $directory)
        {
            $path = explode('/', $directory);
            $service = end($path);
            $namespace = config('make-facades.namespace');
            $serviceClass = "{$namespace}\\{$service}\\{$service}";
            $retrieveService = (new \ReflectionClass($serviceClass));
            $this->bindings[$retrieveService->getShortName()] = $retrieveService->getName();
        }

        return $this;
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
