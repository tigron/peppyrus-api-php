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
	 * @param string $participantId
	 * @return array $participant
	 */
	public static function lookup($scheme, $participantId): array {
		$client = new Client();
		$response = $client->get('/v1/peppol/lookup?scheme=' . $scheme . '&participantId=' . $participantId);
		$json = (string)$response->getBody();

		if ($response->getStatusCode() == 404) {
			throw new \Exception('PEPPOL identifier not found');
		}

		return json_decode($json, true);
	}

	/**
	 * Find best matching participant_id in SMP
	 *
	 * @access public
	 * @param string $scheme
	 * @param string $country_code in format vat BE, NL, FR, ..
	 * @return array $vat_number Without country code => 0123456789
	 */
	public static function best_match(string $country_code, string $vat_number): array {
		$client = new Client();
		$response = $client->get('/v1/peppol/bestMatch?countryCode=' . $country_code . '&vatNumber=' . $vat_number);
		$json = (string)$response->getBody();

		if ($response->getStatusCode() == 404) {
			throw new \Exception('No best match found');
		}

		return json_decode($json, true);
	}

	/**
	 * Search
	 * Search for a participant in PEPPOL directory
	 *
	 * @access public
	 * @param array $parameters
	 *	[
	 *		'query' =>
	 *		'participantId' =>
	 *		'name' =>
	 *		'country' =>
	 *		'geoInfo' =>
	 *		'contact' =>
	 *		'identifierScheme' =>
	 *		'identifierValue' =>
	 *	]
	 * @param string $scheme
	 * @param string $identifier
	 * @return array $participant
	 */
	public static function search($parameters): array {
		$allowed = [
			'query',
			'participantId',
			'name',
			'country',
			'geoInfo',
			'contact',
			'identifierScheme',
			'identifierValue'
		];

		// Cleanup $parameters
		foreach ($parameters as $key => $value) {
			if (!in_array($key, $allowed)) {
				unset($parameters[$key]);
			}
		}


		$query = http_build_query($parameters);

		$client = new Client();
		$response = $client->get('/v1/peppol/search?' . $query);
		$json = (string)$response->getBody();
		return json_decode($json, true);
	}
}
