<?php

declare(strict_types=1);

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;

class CheckSafeUrlService
{
	private const GOOGLE_SAFE_API = "https://safebrowsing.googleapis.com/v4/threatMatches:find";

	public function __construct(
		private Client $client,
		private string $apiKey
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

		$response = $this->client->post(self::GOOGLE_SAFE_API, [
			RequestOptions::QUERY => [
				'key' => $this->apiKey
			],
			RequestOptions::BODY => json_encode($requestBody)
		]);
		return empty(json_decode($response->getBody()->getContents(), true));
	}
}