<?php

namespace Startup;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class StartupServiceProvider extends ServiceProvider
{
    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'can_register' => \Startup\Http\Middleware\CanRegister::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'admin' => [
            'admin.auth',
        ],
    ];

	/**
	 * Perform post-registration booting of services.
	 *
	 * @return void
	 */
	public function boot()
	{
		if ($this->app->runningInConsole()) {
			$this->publishResources();
			$this->registerCommands();
		}

		$this->loadResources();
		
        if (! $this->app->configurationIsCached()) {
			$this->mergeConfigFrom(__DIR__ . '/../config/startup.php', 'startup');
		}

        // Helpers
        $this->registerHelpers();
	}

	public function publishResources()
	{
		$this->publishes([
			__DIR__ . '/../config/startup.php' => config_path('startup.php')
		], 'startup-config');

		$this->publishes([
			__DIR__ . '/../public' => public_path('vendor/startup')
		], 'startup-assets');

		$this->publishes([
			__DIR__ . '/../resources/lang' => resource_path('lang/vendor/startup')
		], 'startup-translations');

		$this->publishes([
			__DIR__ . '/../resources/views' => resource_path('views/vendor/startup'),
		], 'startup-views');

		$this->publishes([
			__DIR__ . '/../resources/sass' => resource_path('sass'),
		], 'startup-sass');

		$this->publishes([
			__DIR__ . '/../resources/sass' => resource_path('js'),
		], 'startup-js');
	}

	public function loadResources()
	{
		// Migrations
		$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // Translations
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'startup');

		// Views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'startup');

		// Route Initiator
		$this->loadRoutes();
	}

	public function loadRoutes()
	{
		$this->loadRoutesFrom(__DIR__ . '/../routes/frontend.php');

		$userRouteFile = env('routes_file', 'frontend.php');
		$userRoutePath = base_path('routes/' . $userRouteFile);

		if (file_exists($userRoutePath)) {
			$this->loadRoutesFrom($userRoutePath);
		}
	}

	/**
	 * Register any package services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerThirdPartyVendors();
        $this->registerRouteMiddleware();
	}

	public function registerThirdPartyVendors()
	{		
		// Laravel Collective: HTML
		$this->app->register(\Collective\Html\HtmlServiceProvider::class);
		AliasLoader::getInstance(['Form' => \Collective\Html\FormFacade::class]);
		AliasLoader::getInstance(['Html' => \Collective\Html\HtmlFacade::class]);
	}

	public function registerCommands()
	{
		$this->commands([
			Console\Commands\InstallCommand::class,
		]);
	}

	public function registerHelpers()
	{
		foreach (glob(__DIR__ . '/Helpers/*.php') as $filename) {
			require_once($filename);
		}
	}

    /**
     * Register the route middleware.
     *
     * @return void
     */
    protected function registerRouteMiddleware()
    {
        // register route middleware.
        foreach ($this->routeMiddleware as $key => $middleware) {
            app('router')->aliasMiddleware($key, $middleware);
        }

        // register middleware group.
        foreach ($this->middlewareGroups as $key => $middleware) {
            app('router')->middlewareGroup($key, $middleware);
        }
    }
}
