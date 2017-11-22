<?php

namespace Semaphore;

use GuzzleHttp\Client;

class SemaphoreApi {

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

	    if ($senderId != null) {
	        $params['form_params']['sendername'] = $senderId;
	    }

	    if ($bulk != true) {
	        $response = $this->client->post('messages', $params);
	    } else {
	        $response = $this->client->post('messages', $params);
	    }

	    return $response->getBody();
	}

	public function message($messageId)
	{
		$params = [
            'form_params' => [
	            'apikey' =>  $this->apiKey,
            ]
        ];

        $response = $this->client->get('messages/' . $messageId, $params);

        return $response->getBody();
	}

	public function messages(array $options = null)
	{
    	$params = [
            'query' => [
	            'apikey' =>  $this->apiKey,
	            'limit' => 100,
                'page' => 1
            ]
		];
		
		if (isset($options)) {
			if (array_key_exists('limit', $options)) {
				$params['query']['limit'] = $options['limit'];
			}

			if (array_key_exists('page', $options)) {
				$params['query']['page'] = $options['page'];
			}

			if (array_key_exists('startDate', $options)) {
				$params['query']['startDate'] = $options['startDate'];
			}

			if (array_key_exists('endDate', $options)) {
				$params['query']['endDate'] = $options['endDate'];
			}

			if (array_key_exists('status', $options)) {
				$params['query']['status'] = $options['status'];
			}

			if (array_key_exists('network', $options)) {
				$params['query']['network'] = $options['network'];
			}

			if (array_key_exists('sendername', $options)) {
				$params['query']['sendername'] = $options['sendername'];
			}
		}
	    
	    $response = $this->client->get('messages', $params);

        return $response->getBody();
	}

	public function account()
	{
		$params = [
	        'query' => [
	            'apikey' => $this->apiKey
	        ]
		];
		
		$response = $this->client->get('account', $params);
		
		return $response->getBody();
	}


	public function transactions(array $options = null)
	{
		$params = [
            'query' => [
	            'apikey' =>  $this->apiKey,
	            'limit' => 100,
                'page' => 1
            ]
		];
		
		if (isset($options)) {
			if (array_key_exists('limit', $options)) {
				$params['query']['limit'] = $options['limit'];
			}

			if (array_key_exists('page', $options)) {
				$params['query']['page'] = $options['page'];
			}
		}
		$response = $this->client->get('account/transactions', $params);

		return $response->getBody();
	}


	public function senderNames(array $options = null)
	{
		$params = [
			'query' => [
				'apikey' => $this->apiKey,
				'limit' => 100,
				'page' => 1
			]
		];
		
		if(isset($options)) {
			if (array_key_exists('limit', $options)) {
				$params['query']['limit'] = $options['limit'];
			}

			if (array_key_exists('page', $options)) {
				$params['query']['page'] = $options['page'];
			}
		}
	    
		$response = $this->client->get('account/sendernames', $params);

		return $response->getBody();
	}

	public function users(array $options = null)
	{
		$params = [
            'query' => [
	            'apikey' =>  $this->apiKey,
	            'limit' => 100,
                'page' => 1
            ]
        ];
		if (isset($options)) {
			if (array_key_exists('limit', $options)) {
				$params['query']['limit'] = $options['limit'];
			}
	
			if (array_key_exists('page', $options)) {
				$params['query']['page'] = $options['page'];
			}
		}
	    
		$response = $this->client->get('account/users', $params);

		return $response->getBody();
	}
}