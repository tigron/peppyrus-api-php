<?php

declare(strict_types=1);

/**
 * Client for Peppyrus API
 *
 * @author Roan Buysse <roan@tigron.be>
 */

namespace Peppyrus\Api;

class Organization {

	/**
	 * Retreive
	 * Retreive the organization info that is stored in Peppyrus
	 *
	 * @access public
	 * @return array $organization_info
	 */
	public static function get_info(): array {
		$client = new Client();
		$response = $client->get('/v1/organization/info');
		$json = (string)$response->getBody();
		return json_decode($json, true);
	}


	/**
	 * Retreive
	 * Retreive the specific peppol info for your organization from Peppyrus (the participant_ids)
	 *
	 * @access public
	 * @return array $peppol_participants
	 */
	public static function get_peppol_participants(): array {
		$client = new Client();
		$response = $client->get('/v1/organization/peppol');
		$json = (string)$response->getBody();
		return json_decode($json, true);
	}
}
