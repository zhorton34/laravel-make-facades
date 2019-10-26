#### Aritsan Command To Make a Service and related ServiceFacade

**Installation**
1. `composer require clean-code-studio/laravel-facade-generator`

**Example**
1. Execute `php artisan make:facade MyCoolClass`
2. Automatically Generates The Following Generated Files Based On Custom Stubs That automatically sets the namespace and class information
   App\Facades\MyCoolClass\MyCoolClass.php
   App\Facades\MyCoolClass\MyCoolClassFacade.php

**Extra Configuration**
1. `php artisan publish` 
2. Select to Publish CleanCodeStudio\Facades config file
3. This will publish a `config/make-facade.php` file

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


