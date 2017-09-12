<?php

namespace Semaphore;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class SemaphoreServiceProvider extends ServiceProvider {

	/**
	* Register the service provider.
	*
	* @return void
	*/

	public function register()
	{
		$this->app->bind('semaphore', function() {
			$client = new Client(['base_uri' => 'http://api.semaphore.co/']);
			return new SemaphoreAPI($client);
		});
	}
}