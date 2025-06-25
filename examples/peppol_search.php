<?php

include 'config.php';

/**
 * Search for PEPPOL participants in PEPPOL Directory (https://directory.peppol.eu/public)
 * This will an array of search matches
 */


/**
 * Define the search parameters
 *
 * Available parameters are:
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
 */
$parameters = [
	'participantId' => '9925:be0886776275',
];


$response = Peppyrus\Api\Peppol::search($parameters);
/**
 * The response will contain an array of participants:
 *
 * Array
 * (
 *    [0] => Array
 *        (
 *            [participant] => Array
 *                (
 *                    [scheme] => iso6523-actorid-upis
 *                    [identifier] => 9925:be0886776275
 *                )
 *
 *            [entities] => Array
 *                (
 *                    [0] => Array
 *                        (
 *                            [name] => Array
 *                                (
 *                                    [0] => Array
 *                                        (
 *                                            [name] => Tigron BV
 *                                            [language] => en
 *                                        )
 *
 *                                )
 *
 *                            [geoInfo] => Zaventem, Belgium
 *                            [identifiers] => Array
 *                                (
 *                                    [0] => Array
 *                                        (
 *                                            [scheme] => VAT
 *                                            [value] => 0886776275
 *                                        )
 *
 *                                )
 *
 *                            [website] => Array
 *                                (
 *                                    [0] => https://www.tigron.be
 *                                )
 *
 *                            [contacts] => Array
 *                                (
 *                                    [0] => Array
 *                                        (
 *                                            [type] => Technical
 *                                            [name] => Christophe Gosiau
 *                                            [phone] => +32.26090000
 *                                            [email] => christophe.gosiau@tigron.be
 *                                        )
 *
 *                                )
 *
 *                            [additionalInfo] => Provided by Peppyrus.be
 *                            [regDate] => 2025-05-26
 *                        )
 *
 *                )
 *
 *        )
 *
 * )
 *
 */



