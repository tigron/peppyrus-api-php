<?php

include 'config.php';


$id = 'f87ebce9-fae2-4722-bebe-62ee89e95e29';
$response = Peppyrus\Api\Message::confirm($id);

/**
 * The response will look like this:
 *
 *	true
 *
*/