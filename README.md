#### Aritsan Command To Make a Service and related ServiceFacade

**Installation**
1. `composer require clean-code-studio/laravel-make-facades`

**Example**
1. Execute `php artisan make:facade MyCoolService` Scaffolds

This Command Scaffolds Two New Classes.

A: Your Service Class (`App\Facades\MyCoolClass\MyCoolClass.php`)
```
<?php

namespace App\Facades\MyCoolService;


class MyCoolService
{
    // create MyCoolService class
}
```

B. Your Services Facade Class (`App\Facades\MyCoolClass\MyCoolClassFacade.php`)
```
<?php

namespace App\Facades\MyCoolService;

use Illuminate\Support\Facades\Facade;

class MyCoolServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'MyCoolService';
    }
}

```


**Extra Configuration**
1. Execute `php artisan publish` 
2. Choose To Publish `CleanCodeStudio\MakeFacades config`
3. This will publish a `config/make-facades.php` configuration file

```
// config/make-facade.php example

return [
	// Directory path save your facades
	'path' => 'app/facades',

	// Namespace Of Your Facades
	'root_namespace' => 'App\\Facades',

	// Auto Alias Facades
	// Only works if 
	// 1. You use php artisan publish to add the AliasCreatedFacadesServiceProvider
	// 2. All Service Classes Related To Generated Facades are registered to AliasCreatedFacadesService Provider's $bindings = [] array 
	'auto_alias_facades' => true,
];
```

**Auto Alias Generated Facades**
1. Execute `php artisan publish`
2. Choose To Publish `CleanCodeStudio\MakeFacades provider`
3. This will publish a `AutoAliasFacadesServiceProvider.php` to your `app/providers` directory
4. Bind Your `MyCoolService` Class To The Service Container 
   using the `protected $bindings` Array within `AutoAliasFacadesServiceProvider.php`
_Note (You have to use the public $bindings array for this to work properly)_

**Example Of Auto Aliasing Generated Facade Services**
```
<?php

namespace CleanCodeStudio\MakeFacades\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

// Provider Automatically Registered To Application When CleanCodeStudio\MakeFacadeServiceProvider.php Is Registered
class AutoAliasFacadesServiceProvider extends ServiceProvider
{
    // Bind your facade SERVICE class, NOT the service facade class ~ this will automatically 
    // create an alias to your Services facade
    public $bindings = [
        'MyCoolService' => App\Facades\MyCoolService\MyCoolService::class, 
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
```


