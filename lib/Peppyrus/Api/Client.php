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
	 * Logger
	 *
	 * @var \Monolog\Logger
	 */
	private \Monolog\Logger $logger;

	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {
		if (empty(Config::$peppyrus_log_file) === true) {
			parent::__construct([
				'base_uri' => Config::$endpoint,
				'headers' => [
					'Content-Type' => 'application/json',
					'X-Api-Key' => Config::$key,
				],
				'http_errors' => false,
				'exception' => false,
			]);
		} else {
			parent::__construct([
				'base_uri' => Config::$endpoint,
				'headers' => [
					'Content-Type' => 'application/json',
					'X-Api-Key' => Config::$key,
				],
				'handler' => $this->create_logging_handler_stack([
					'{method} {uri} HTTP/{version} {req_body} - {req_headers}',
					"RESPONSE: {code} - {res_body}\n",
				], ),
				'http_errors' => false,
				'exception' => false,
			]);
		}
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
			print_r((string)$response->getBody());
			throw new \Exception('Internal server error');
		}

        return $response;
    }

	/**
	 * Create logging handler stack
	 *
	 * @access public
	 * @param array $message_formats
	 * @return HandlerStack $stack
	 */
	private function create_logging_handler_stack(array $message_formats) {
		$stack = \GuzzleHttp\HandlerStack::create();
		foreach ($message_formats as $message_format) {
			$stack->unshift(
				$this->get_logger($message_format)
			);
		}

		return $stack;
	}

	/**
	 * Get logger
	 *
	 * @access public
	 * @param string $message_format
	 * @return
	 */
	private function get_logger(string $message_format) {
		if (empty($this->logger)) {
			$this->logger = new \Monolog\Logger('tigron/peppyrus-api-php');
			$formatter = new \Monolog\Formatter\LineFormatter(null, null, true, true);
			$handler = new \Monolog\Handler\StreamHandler(Config::$peppyrus_log_file);
			$handler->setFormatter($formatter);
			$this->logger->pushHandler($handler);
		}

		return \GuzzleHttp\Middleware::log(
			$this->logger,
			new \GuzzleHttp\MessageFormatter($message_format)
		);
	}

}
