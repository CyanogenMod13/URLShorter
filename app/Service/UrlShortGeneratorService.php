<?php

declare(strict_types=1);

namespace App\Service;

use App\Exceptions\UrlUnsafeException;
use App\Models\HashedUrl;
use App\Repository\HashedUrlRepository;
use GuzzleHttp\Exception\GuzzleException;

class UrlShortGeneratorService
{
	public function __construct(
		private HashedUrlRepository $repository,
		private HashUrlService $hashUrlService,
		private CheckSafeUrlService $checkSafeUrlService,
		private string $hostName
	) {}

	/**
	 * @throws GuzzleException
	 * @throws UrlUnsafeException
	 */
	public function generateShortUrl(string $originalUrl, ?string $folder = null): string
	{
		if (!$this->checkSafeUrlService->checkSafe($originalUrl)) {
			throw new UrlUnsafeException();
		}

		$hash = $this->hashUrlService->hash($originalUrl . ($folder ?: ''));
		if (!$this->repository->isHashExists($hash)) {
			HashedUrl::createHahsedUrl($originalUrl, $hash, $folder);
		}
		return $this->buildUrl($this->hostName, $folder, $hash);
	}

	private function buildUrl(string $hostName, ?string $folder, string $hash): string
	{
		return $hostName . ($folder ? "/${folder}" : "") . '/' . $hash;
	}
}