<?php

declare(strict_types=1);

/**
 * Client for Peppyrus API
 *
 * @author Christophe Gosiau <christophe@tigron.be>
 */

namespace Peppyrus\Api;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\RequestOptions;

class Client extends \GuzzleHttp\Client {
	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {
		parent::__construct([
			'base_uri' => 'https://api.peppyrus.be/v1',
			'base_uri' => 'http://api.peppyrus.test1.tigron.be/v1',
			'headers' => [
				'Content-Type' => 'application/json',
				'X-Api-Key' => Config::$key,
			],
			'http_errors' => false,
			'exception' => false,
		]);
	}

    /**
     * Create and send an HTTP request.
     *
     * Use an absolute path to override the base path of the client, or a
     * relative path to append to the base path of the client. The URL can
     * contain the query string as well.
     *
     * @param string              $method  HTTP method.
     * @param string|UriInterface $uri     URI object or string.
     * @param array               $options Request options to apply. See \GuzzleHttp\RequestOptions.
     *
     * @throws GuzzleException
     */
    public function request(string $method, $uri = '', array $options = []): ResponseInterface {
        $options[RequestOptions::SYNCHRONOUS] = true;
        $response = $this->requestAsync($method, $uri, $options)->wait();

		if ($response->getStatusCode() === 401) {
			throw new \Exception('Authentication failure');
		}

		if ($response->getStatusCode() === 500) {
			throw new \Exception('Internal server error');
		}

        return $response;
    }	

}
