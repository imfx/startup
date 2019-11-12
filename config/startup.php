<?php

return [
	'route' => [
		'namespace' => '\App\Http\Controllers\Frontend',
		'middleware' => ['web'],
	],

	'directory' => app_path('Http/Controllers/Frontend'),

	'controller' => 'HomeController',

    'registration_enabled' => false,

    'routes_file' => 'frontend.php',
];
