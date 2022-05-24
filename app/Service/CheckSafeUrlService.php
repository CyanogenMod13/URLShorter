<?php

declare(strict_types=1);

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class CheckSafeUrlService
{
	private const GOOGLE_SAFE_API = "https://safebrowsing.googleapis.com/v4/threatMatches:find?key=";

	private array $requestBody = [
		"client" => [
			"clientId" => null,
			"clientVersion" => null
		],
		"threatInfo" => [
			"threatTypes" => ["MALWARE", "SOCIAL_ENGINEERING", "THREAT_TYPE_UNSPECIFIED", "UNWANTED_SOFTWARE", "POTENTIALLY_HARMFUL_APPLICATION"],
			"platformTypes" => ["WINDOWS", "IOS", "OSX", "LINUX", "ANDROID", "CHROME"],
			"threatEntryTypes" => ["URL"],
			"threatEntries" => [
				"url" => null
			]
		]
	];

	public function __construct(
		private Client $client
	)
	{
		$this->requestBody['client']['clientId'] = env('GOOGLE_SAFE_CLIENT_ID');
		$this->requestBody['client']['clientVersion'] = env('GOOGLE_SAFE_CLIENT_VERSION');
	}

	/**
	 * @throws GuzzleException
	 */
	public function checkSafe(string $url): bool
	{
		$apiKey = env('GOOGLE_API_KEY');

		$this->requestBody['threatInfo']['threatEntries']['url'] = $url;
		$response = $this->client->post(self::GOOGLE_SAFE_API . $apiKey, ['body' => json_encode($this->requestBody)]);
		return $response->getBody()->getContents() === "{}\n";
	}
}