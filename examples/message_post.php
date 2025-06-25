<?php

include 'config.php';
include 'ubl.php';


/**
 * Create a UBL invoice
 * Check ubl.php for document creation
 */
$xml_string = create_invoice();

/**
 * Send the invoice
 */

$data = [
	'sender' => '9925:be0886776275',
	'recipient' => '9925:be0886776275',
	'documentType' => 'busdox-docid-qns::urn:oasis:names:specification:ubl:schema:xsd:Invoice-2::Invoice##urn:cen.eu:en16931:2017#compliant#urn:fdc:peppol.eu:2017:poacc:billing:3.0::2.1',
	'processType' => 'cenbii-procid-ubl::urn:fdc:peppol.eu:2017:poacc:billing:01:1.0',
	'fileName' => 'invoice.xml',
	'fileContent' => base64_encode($xml_string),
];


$response = Peppyrus\Api\Message::create($data);


