<?php

namespace Semaphore;

use GuzzleHttp\Client;

class SemaphoreAPI {

	public $apiKey;
	public $senderId = null;
	protected $client;

	public function __construct(Client $client)
	{
		$this->apiKey = env('SEMAPHORE_KEY');
		$this->senderId = env('SEMAPHORE_SENDER');
		$this->client = $client;
	}

	public function send($number, $message, $senderId = null, $bulk = false)
	{
	    $params = [
	        'form_params' => [
	            'apikey' => $this->apiKey,
	            'message' => $message,
	            'number' => $number,
	            'sendername' => $this->senderId
	        ]
	    ];

	    if( $senderId != null )
	    {
	        $params[ 'form_params' ][ 'sendername' ] = $senderId;
	    }

	    if( $bulk != true )
	    {
	        $response = $this->client->post('api/v4/messages', $params );
	    } else {
	        $response = $this->client->post('api/v4/messages', $params );
	    }

	    return $response->getBody();
	}
}