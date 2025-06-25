<?php

include 'config.php';


$id = 'f87ebce9-fae2-4722-bebe-62ee89e95e29';
$response = Peppyrus\Api\Message::get_by_id($id);

/**
 * The response will look like this:
 *
 * Array
 *	(
 *		[id] => f87ebce9-fae2-4722-bebe-62ee89e95e29
 *		[sender] => 9925:be0886776275
 *		[recipient] => 9925:be0886776275
 *		[direction] => IN
 *		[processType] => cenbii-procid-ubl::urn:fdc:peppol.eu:2017:poacc:billing:01:1.0
 *		[documentType] => busdox-docid-qns::urn:oasis:names:specification:ubl:schema:xsd:Invoice-2::Invoice##urn:cen.eu:en16931:2017#compliant#urn:fdc:peppol.eu:2017:poacc:billing:3.0::2.1
 *		[fileContent] => PHhtbD4KCTx0YWc+dGVzdDwvdGFnPgo8L3htbD4K
 *		[created] => 2025-05-27 22:23:40
 *		[confirmed] => 1
 *	)
 *
 *
*/