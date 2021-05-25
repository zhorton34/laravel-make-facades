<?php

return [
	// Path where facades and facade service classes are saved
	'path' => 'app/Facades',

	// Namespace Of Your Facades
	'namespace' => 'App\\Facades',

	// Recommended "providers" or "Providers" app_path is automatically applied
	// (@see https://github.com/zhorton34/laravel-make-facades/issues/4)
	'providers_path' => 'Providers',

	// Automatically Bind Facade Service Classes To Container And Register Facade Aliases
	'auto_alias_facades' => true,
];