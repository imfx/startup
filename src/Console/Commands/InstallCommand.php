<?php

namespace Startup\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;

class InstallCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'startup:install';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Install Startup Package';

	/**
	 * Install directory.
	 *
	 * @var string
	 */
	protected $directory = '';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(Filesystem $filesystem)
	{
		parent::__construct();

		$this->filesystem = $filesystem;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$this->comment(PHP_EOL . 'Startup installation started' . PHP_EOL);

		$this->line('→ Publishing Startup Service Provider ... <info>✔</info>');
		$this->callSilent('vendor:publish', [
			'--provider' => 'Startup\StartupServiceProvider',
		]);

		$this->initializeBackendDir();

		$this->info(PHP_EOL . 'Done.');
	}

	public function initializeBackendDir()
	{
		$this->line('→ Initializing Startup directory ... <info>✔</info>');

		$this->directory = config('startup.directory');
		$this->makeDir('/');

		$this->createHomeController();
	}

	/**
	 * Create Frontend Controller
	 *
	 * @return void
	 */
	public function createHomeController()
	{
		$filename = config('startup.controller');
		
		$appController = $this->directory . '/' . $filename . '.php';
		$contents = $this->getStub($filename);

		$this->filesystem->put($appController, $contents);
	}

	/**
	 * Get stub contents.
	 *
	 * @param $name
	 *
	 * @return string
	 */
	protected function getStub($name)
	{
		return $this->filesystem->get(__DIR__ . '/stubs/' . $name . '.stub');
	}

	/**
	 * Make new directory.
	 *
	 * @param string $path
	 */
	protected function makeDir($path = '')
	{
		$this->filesystem->makeDirectory("{$this->directory}/$path", 0755, true, true);
	}
}
