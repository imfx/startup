<?php

namespace Startup\Facades;

use Illuminate\Support\Facades\Facade;

class Startup extends Facade
{
	protected static function getFacadeAccessor()
	{
		return \Startup\Startup::class;
	}
}
