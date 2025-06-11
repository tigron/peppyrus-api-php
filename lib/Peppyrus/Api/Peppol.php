<?php

declare(strict_types=1);

/**
 * Client for Peppyrus API
 *
 * @author Christophe Gosiau <christophe@tigron.be>
 */

namespace Peppyrus\Api;

class Peppol {

	/**
	 * Lookup
	 * Lookup participant capabilities in SMP
	 *
	 * @access public
	 * @param string $scheme
	 * @param string $identifier
	 * @return array $participant
	 */
	public static function lookup($scheme = 'iso6523-actorid-upis', $identifier): array {
		$client = new Client();
		$response = $client->get('/v1/peppol/lookup?scheme=' . $scheme . '&identifier=' . $identifier);
		
	}

}
