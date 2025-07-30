<?php
/**
 * Config class
 *
 * @author Christophe Gosiau <christophe@tigron.be>
 */

namespace Peppyrus\Api;

class Config {
	/**
	 * Key
	 *
	 * The API key for Peppyrus
	 *
	 * @access public
	 * @var string $key
	 */
	public static $key = '';

	/**
	 * API endpoint
	 * 
	 * @access public
	 * @var string $endpoint	 
	 */
	public static $endpoint = 'https://api.peppyrus.be/v1';
}
