## Laravel - Make Facades Package

1. [Installation](#installation)
2. [Publish Package via Artisan](#publish-package-via-artisan)
3. [Configure Package Settings](#configure-package-settings)
4. [Use Make Facades Service](#use-make-facades-service)
5. [Laravel Make Facades Youtube Tutorial](#laravel-make-facades-youtube-tutorial)
6. [In Closing](#in-closing)
 

**Youtube Tutorial For This Package**
<a href="https://youtu.be/Go0JBT98uOw?t=380" target="_blank"><img src="http://img.youtube.com/vi/Go0JBT98uOw/0.jpg" width='750' height='500' border='10' alt="Clean Code Studio Talking About Laravel Facades and Laravel Make Facades Package Tutorial" width="800" height="500" border="10" />

Laravel Make Facades (Simplified Package Tutorial)


</a>

## Installation

---

**Comoser Install**
```php
composer require clean-code-studio/laravel-make-facades --dev
```

## Publish Package via Artisan

**Publish Configuration File**
 - `php artisan vendor:publish` 
 - Select `CleanCodeStudio\MakeFacades\ServiceProvider`

## Configure Package Settings
**Define Config Settings**
 - Open `config/make-facades.php` 
    - **Note:** `config/make-facades.php` is created during the previous step when we publish this package via artisan
 - Configure `config/make-facades.php` settings
   - **Path:** Facades folder path (where new facades created using this package will be stored)
   - **Namespace:** Namespace for every facade created using this package
   - **Providers Path:** Updated to support Laravel 8 release (See @see https://github.com/zhorton34/laravel-make-facades/issues/4)
   - **Auto Alias Facades:** Whether you want to automatically bind all services within a given folder to its own Facade automatically.

**Laravel Make Facades - Config Settings**
- **File Path:** `config/make-facade.php example`
```php
return [
   // Directory path save your facades
   'path' => 'app/facades',

  // Namespace Of Your Facades
  'namespace' => 'App\\Facades',

  // Providers path (@see https://github.com/zhorton34/laravel-make-facades/issues/4)
  'providers_path' => 'app/Providers',
  
  // This will find all of the aliases and services defined in your path settings and
  // 1. Bind the service classes for each facade to the service container automatically
  // 2. Register aliases for each facade base on the Class Name the Facade Reference to the service container automatically
  'auto_alias_facades' => true,
];
```

## Use Make Facades Service

1. Run: `php artisan make:facade MyCoolService`
   - Creates Scaffold for `MyCoolService` class
   - Creates Scaffold for `MyCoolServiceFacade` class
   - **Note:** 
    - If `'auto_alias_facades' => true` in `config/make-facade.php` then the service will automatically be binded to your service container
    - If `'auto_alias_facades' => false` in `config/make-facade.php` then you need to bind your generated service class to
     the service container in any service provider for the facade to properly work. 
   
**MyCoolService Class**
- By Default created to `App\Facades\MyCoolService\MyCoolService.php`
```php
<?php

namespace App\Facades\MyCoolService;

class MyCoolService
{
    // create MyCoolService class
}
```

**MyCoolServiceFacade Class**
-  By Default created to `App\Facades\MyCoolService\MyCoolServiceFacade.php`
```php
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

**Note: auto_alias_facades in config** 
- If `'auto_alias_facades' => true` in `config/make-facade.php` then the service will automatically be binded to your service container
- If `'auto_alias_facades' => false` in `config/make-facade.php` then you need to bind your generated service class to
     the service container in any service provider for the facade to properly work. 



## Laravel Make Facades Youtube Tutorial

---
<a href="https://youtu.be/Go0JBT98uOw?t=380" target="_blank"><img src="http://img.youtube.com/vi/Go0JBT98uOw/0.jpg" width='750' height='500' border='10' alt="Clean Code Studio Talking About Laravel Facades and Laravel Make Facades Package Tutorial" width="800" height="500" border="10" />

Laravel Make Facades (Simplified Package Tutorial)


</a>

- Screencast 
   - Laravel Facades Tutorial
   - This package's installation and usage


## In Closing
- A. Remember You Can Auto Bind The Services and Auto Aliases Your Service Facades Simply By Setting
    `auto_alias_facades` to TRUE within you `config/make-facades.php` file! Simple, quick, and easy.

- B. If you do change your namespace or file path in your config, 
   Facades and Facade Services within the old namespace and old file path
    WILL NOT AUTOMATICALLY REGISTER TO THE CONTAINER.

- C. If you do not want to auto register or automatically add the aliases for your generated facades, simply set
   `auto_alias_facades` to false within your `config/make-facades.php` file


[Clean Code](https://cleancode.studio/clean-code)

[Clean Code Studio](https://cleancode.studio)


_Clean Code Studio ~ Clean Code Clean Life ~ Simplify!_
