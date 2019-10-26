<?php

return [
	// Directory path save your facades
	'path' => 'app/facades',

	// Namespace Of Your Facades
	'root_namespace' => 'App\\Facades',

	// Auto Alias Facades only works if:
	// ---------------------------------------
	// 1. You use php artisan publish to add the AliasCreatedFacadesServiceProvider
	// 2. All Service Classes Related To Generated Facades are registered to AliasCreatedFacadesService Provider's $bindings = [] array 
	'auto_alias_facades' => true,
];