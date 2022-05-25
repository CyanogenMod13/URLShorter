<?php

declare(strict_types=1);

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;

class CheckSafeUrlService
{
	public function __construct(
		private Client $client,
		private string $apiKey,
		private string $apiUrl
	) {}

	/**
	 * @throws GuzzleException
	 */
	public function checkSafe(string $url): bool
	{
		$requestBody = [
			"threatInfo" => [
				"threatTypes" => ["MALWARE", "SOCIAL_ENGINEERING", "THREAT_TYPE_UNSPECIFIED", "UNWANTED_SOFTWARE", "POTENTIALLY_HARMFUL_APPLICATION"],
				"platformTypes" => ["WINDOWS", "IOS", "OSX", "LINUX", "ANDROID", "CHROME"],
				"threatEntryTypes" => ["URL"],
				"threatEntries" => [
					"url" => $url
				]
			]
		];

		$response = $this->client->post($this->apiUrl, [
			RequestOptions::QUERY => [
				'key' => $this->apiKey
			],
			RequestOptions::BODY => json_encode($requestBody)
		]);
		return empty(json_decode($response->getBody()->getContents(), true));
	}
}