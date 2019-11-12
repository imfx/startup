<?php

/*
|----------------------------------------------
| Frontend Routes - (Public)
|----------------------------------------------
*/

Route::group([
	'prefix'		=> config('startup.route.prefix'),
	'middleware'	=> config('startup.route.middleware'),
	'namespace'		=> config('startup.route.namespace'),
], function () {
	Auth::routes();
	Route::get('/', 'AppController@index')->name('app');
});
