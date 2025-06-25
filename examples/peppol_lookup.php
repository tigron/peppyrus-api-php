<?php

include 'config.php';

/**
 * Perform a PEPPOL lookup on a given Participant ID
 * This will return information about the available services for this participant
 */
try {
	$response = Peppyrus\Api\Peppol::lookup('iso6523-actorid-upis', '9925:be0886776275');
} catch (\Exception $e) {
	// In case the identifier cannot be found, an exception will be thrown
}

/**
 * The response will look like this:
 *
 *	Array
 *	(
 *		[scheme] => iso6523-actorid-upis
 *		[identifier] => 9925:be0886776275
 *		[services] => Array
 *		    (
 *		        [0] => Array
 *		            (
 *		                [documentType] => busdox-docid-qns::urn:oasis:names:specification:ubl:schema:xsd:CreditNote-2::CreditNote##urn:cen.eu:en16931:2017#compliant#urn:fdc:peppol.eu:2017:poacc:billing:3.0::2.1
 *		                [process] => cenbii-procid-ubl::urn:fdc:peppol.eu:2017:poacc:billing:01:1.0
 *		                [transportProfile] => peppol-transport-as4-v2_0
 *		                [endpoint] => https://ap.peppol.tigron.be/domibus/services/msh
 *		                [description] => Peppol BIS Billing UBL Credit Note V3
 *		                [contact] => support@tigron.be
 *		            )
 *
 *		        [1] => Array
 *		            (
 *		                [documentType] => busdox-docid-qns::urn:oasis:names:specification:ubl:schema:xsd:Invoice-2::Invoice##urn:cen.eu:en16931:2017#compliant#urn:fdc:peppol.eu:2017:poacc:billing:3.0::2.1
 *		                [process] => cenbii-procid-ubl::urn:fdc:peppol.eu:2017:poacc:billing:01:1.0
 *		                [transportProfile] => peppol-transport-as4-v2_0
 *		                [endpoint] => https://ap.peppol.tigron.be/domibus/services/msh
 *		                [description] => Peppol BIS Billing UBL Invoice V3
 *		                [contact] => support@tigron.be
 *		            )
 *
 *		    )
 *
 *	)
 */



