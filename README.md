#### php artisan make:facade {ServiceClassName}

Youtube Tutorial Of Laravel Facades And Then Implementing Facades using this package: 
https://www.youtube.com/watch?v=Go0JBT98uOw

**Step 1. Installation**
 - `composer require clean-code-studio/laravel-make-facades`

**Step 2. Publish Config**
 - `php artisan vendor:publish` 
 - Select CleanCodeStudio\MakeFacades\ServiceProvider

**Step 3. Define Config Settings (config/make-facades.php published in step 2)**
 - Open make-facades.php which was published to your app/config directory in step 2
 - Define Your settings when you run the php artisan make:facade {ServiceClassName} Command

```
// config/make-facade.php example

return [
	// Directory path save your facades
	'path' => 'app/facades',

	// Namespace Of Your Facades
	'namespace' => 'App\\Facades',

	// This will find all of the aliases and services defined in your path settings and
	// 1. Bind the service classes for each facade to the service container automatically
	// 2. Register aliases for each facade base on the Class Name the Facade Reference to the service container  
        //    automatically
	'auto_alias_facades' => true,
];
```

**Step 4. Run php artisan make:facade MyCoolService to quickly scaffold out application services!**

  - Your Service Class Scaffold (`App\Facades\MyCoolService\MyCoolService.php`)
```
<?php

namespace App\Facades\MyCoolService;


class MyCoolService
{
    // create MyCoolService class
}
```

  - Your Services Facade Class Scaffold (`App\Facades\MyCoolService\MyCoolServiceFacade.php`)
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


**In Closing**
A. Remember You Can Auto Bind The Services and Auto Aliases Your Service Facades Simply By Setting
   `auto_alias_facades` to TRUE within you `config/make-facades.php` file! Simple, quick, and easy.

B. If you do change your namespace or file path in your config, 
   Facades and Facade Services within the old namespace and old file path
   WILL NOT AUTOMATICALLY REGISTER TO THE CONTAINER.

C. If you do not want to auto register or automatically add the aliases for your generated facades, simply set
   `auto_alias_facades` to false within your `config/make-facades.php` file


Thanks for your support!

_Clean Code Studio ~ Zak Horton ~ Simplify!_
