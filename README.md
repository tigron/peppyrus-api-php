<h1 align="center">Peppyrus API client for PHP</h1>


## Requirements ##
To use Peppyrus API client, the following things are required:

+ Create a free [Peppyrus account](https://customer.peppyrus.be/register)
+ Register your Participant ID
+ PHP >= 7.4
+ cUrl >= 7.19.4

## Installation

via composer:

    composer require tigron/peppyrus-api-php


## Howto

### Authentication

Make sure you set the API key:

    \Peppyrus\Api\Config::$key = 'YOUR_API_KEY';

In case you want to use the test API, please change the Endpoint to:

    \Peppyrus\Api\Config::$endpoint = 'https://api.test.peppyrus.be';


### Peppol search operations

Lookup participant capabilities in SMP. This will return a list of document types that are supported by the participant.

    $response = Peppyrus\Api\Peppol::lookup('iso6523-actorid-upis', '9925:be0886776275');

Search a Participant in the [Peppol directory](https://directory.peppol.eu/public) based on search parameters.

    $parameters = [ 'query' => 'peppyrus' ];
    $response = Peppyrus\Api\Peppol::search($parameters);

The following parameters are available:

| parameter 	| Description					|
| ---------		| -----------					|
| query			| Generic query term			|
| participantId	| Searches for exact matches in the Peppol participant identifier field (the identifier scheme must be part of the value)|
| name			| Searches for partial matches in business entity names		|
| country		| Searches for exact matches in business entity country codes (ISO-2 code)	|
| geoInfo		| Searches for partial matches in the geographical information			|
| identifierScheme			| Searches for exact matches in the additional identifier schemes. Combine it with identifierValue for fine grained search results.		|
| identifierValue			| Searches for exact matches in the additional identifier values. Combine it with identifierScheme for fine grained search results.		|
| contact		| Searches for partial matches in the business entity contact information. It searches in all sub-fields of contact (type, name, phone number and email address).|



    
