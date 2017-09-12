<?php

namespace Semaphore;

use Illuminate\Support\Facades\Facade;

class Semaphore extends Facade {

	public static function getFacadeAccessor()
	{
		return 'semaphore';
	}
}