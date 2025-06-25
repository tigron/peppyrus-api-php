<?php

include 'config.php';

/**
 * Get the list parameters
 *
 * Available parameters are:
 * @param array $parameters
 *	[
 *		'folder' =>
 *		'sender' =>
 *		'receiver' =>
 *		'confirmed' =>
 *		'page' =>
 *		'perPage' =>
 *	]
 */

$parameters = [
	'folder' => 'INBOX',
	'sender' => '9925:be0886776275',
	'perPage' => 3,
	'confirmed' => 0,
];

$response = Peppyrus\Api\Message::get_list($parameters);

/**
 * The response will look like this:
 *
 *	Array
 *	(
 *		[items] => Array
 *			(
 *            [0] => Array
 *                (
 *                    [id] => f87ebce9-fae2-4722-bebe-62ee89e95e29
 *                    [sender] => 9925:be0886776275
 *                    [recipient] => 9925:be0886776275
 *                    [direction] => IN
 *                    [fileContent] => PHhtbD4KCTx0YWc+dGVzdDwvdGFnPgo8L3htbD4K
 *                    [created] => 2025-05-27 22:23:40
 *                    [confirmed] => 1
 *                )
 *
 *            [1] => Array
 *                (
 *                    [id] => e315b41b-92d6-4b5c-b007-95c401b52915
 *                    [sender] => 9925:be0886776275
 *                    [recipient] => 9925:be0886776275
 *                    [direction] => IN
 *                    [fileContent] => PHhtbD4KCTx0YWc+dGVzdDwvdGFnPgo8L3htbD4K
 *                    [created] => 2025-05-27 22:23:40
 *                    [confirmed] =>
 *                )
 *
 *            [2] => Array
 *                (
 *                    [id] => 2e9d2c06-1757-45a2-833d-aaf1e037c327
 *                    [sender] => 9925:be0886776275
 *                    [recipient] => 9925:be0886776275
 *                    [direction] => IN
 *                    [fileContent] => PHhtbD4KCTx0YWc+dGVzdDwvdGFnPgo8L3htbD4K
 *                    [created] => 2025-05-27 22:23:40
 *                    [confirmed] =>
 *                )
 *
 *
 *			)
 *
 *		[meta] => Array
 *			(
 *				[pages] => 6
 *				[currentPage] => 1
 *				[itemCount] => 17
 *			)
 *	)
*/
