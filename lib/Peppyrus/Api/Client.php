<?php

declare(strict_types=1);

/**
 * Client for Peppyrus API
 *
 * @author Christophe Gosiau <christophe@tigron.be>
 */

namespace Peppyrus\Api;

class Client extends \GuzzleHttp\Client {
	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {
		parent::__construct([
			'base_uri' => 'https://api.peppyrus.be/v1',
			'headers' => [
				'Content-Type' => 'application/json',
			],
			'http_errors' => false,
			'exception' => false,
		]);
	}

}
