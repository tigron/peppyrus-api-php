<?php

declare(strict_types=1);

/**
 * Client for Peppyrus API
 *
 * @author Christophe Gosiau <christophe@tigron.be>
 */

namespace Peppyrus\Api;

class Message {

	/**
	 * ID
	 *
	 * @access public
	 * @var string $id
	 */
	public $id;

	/**
	 * Sender
	 *
	 * @access public
	 * @var string $sender
	 */
	public $sender;

	/**
	 * Recipient
	 *
	 * @access public
	 * @var string $recipient
	 */
	public $recipient;

	/**
	 * Direction
	 *
	 * @access public
	 * @var string $direction (IN|OUT)
	 */
	public $direction;

	/**
	 * fileContent
	 *
	 * @access public
	 * @var string $fileContent
	 */
	public $fileContent;

	/**
	 * created
	 *
	 * @access public
	 * @var string $created
	 */
	public $created;

	/**
	 * confirmed
	 *
	 * @access public
	 * @var bool $confirmed
	 */
	public $confirmed;

	/**
	 * Load
	 *
	 * @access public
	 * @param array $data
	 */
	private function load($data): void {
		$this->id = $data['id'];
		$this->sender = $data['sender'];
		$this->recipient = $data['recipient'];
		$this->direction = $data['direction'];
		$this->fileContent = base64_decode($data['fileContent']);
		$this->created = $data['created'];
		$this->confirmed = $data['confirmed'];
	}

	/**
	 * Create
	 * Lookup message
	 *
	 * @access public
	 * @param array $data
	 * @return self $message
	 */
	public static function create($data): array {
		$client = new Client();
		$data = [
			'body' => json_encode($data),
		];

		$response = $client->post('/v1/message', $data);
		$json = (string)$response->getBody();

		if ($response->getStatusCode() == 422) {
			throw new \Exception((string)$response->getBody());
		}
		if ($response->getStatusCode() == 404) {
			throw new \Exception('PEPPOL identifier not found');
		}

		return json_decode($json, true);
	}

	/**
	 * Get List
	 * Retrieve a list of messages
	 *
	 * @access public
	 * @param array $data
	 * @return self $message
	 */
	public static function get_list($parameters): array {
		$client = new Client();
		$allowed = [
			'folder',
			'sender',
			'receiver',
			'confirmed',
			'page',
			'perPage'
		];

		// Cleanup $parameters
		foreach ($parameters as $key => $value) {
			if (!in_array($key, $allowed)) {
				unset($parameters[$key]);
			}
		}

		$query = http_build_query($parameters);
		$response = $client->get('/v1/message/list?' . $query);
		$json = (string)$response->getBody();
		return json_decode($json, true);
	}

	/**
	 * Get by id
	 * Retreive a message and its content
	 *
	 * @param string $id
	 * @return array
	 */
	public static function get_by_id($id): array {
		$client = new Client();
		$response = $client->get('/v1/message/' . $id);
		$json = (string)$response->getBody();

		if ($response->getStatusCode() == 404) {
			throw new \Exception('Message not found');
		}

		return json_decode($json, true);
	}

	/**
	 *
	 * Render the content (UBL) in HTML or as a PDF
	 *
	 * @param string $id
	 * @param string $type PDF|HTML
	 * @return array
	 */
	public static function render($id, string $type = 'PDF'): array {
		$client = new Client();
		$response = $client->get('/v1/message/' . $id . '/render?' . $type);
		$json = (string)$response->getBody();

		if ($response->getStatusCode() == 404) {
			throw new \Exception('Message not found');
		}

		return json_decode($json, true);
	}

	/**
	 * Get the report for a specific message
	 *
	 * @param string $id
	 * @return array
	 */
	public static function report($id): array {
		$client = new Client();
		$response = $client->get('/v1/message/' . $id . '/report');
		$json = (string)$response->getBody();

		if ($response->getStatusCode() == 404) {
			throw new \Exception('Message not found');
		}

		return json_decode($json, true);
	}

	/**
	 * Confirm
	 * Confirm the good reception of the message
	 *
	 * @param  mixed $id
	 * @return array
	 */
	public static function confirm($id): bool {
		$client = new Client();
		$response = $client->patch('/v1/message/' . $id . '/confirm');
		$json = (string)$response->getBody();

		if ($response->getReasonPhrase() == "Already confirmed") {
			throw new \Exception('Already confirmed');
		}

		if ($response->getStatusCode() == 404) {
			throw new \Exception('Message not found');
		}

		return json_decode($json, true);
	}

}
