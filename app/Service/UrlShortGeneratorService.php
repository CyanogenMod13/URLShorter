<?php

declare(strict_types=1);

namespace App\Service;

use App\Exceptions\UrlUnsafeException;
use App\Models\HashedUrl;
use App\Repository\HashedUrlRepository;
use GuzzleHttp\Exception\GuzzleException;

class UrlShortGeneratorService
{
	private string $hostName;

	public function __construct(
		private HashedUrlRepository $repository,
		private HashUrlService $hashUrlService,
		private CheckSafeUrlService $checkSafeUrlService
	) {
		$this->hostName = env('APP_URL');
	}

	/**
	 * @throws GuzzleException
	 * @throws UrlUnsafeException
	 */
	public function generateShortUrl(string $originalUrl, string $folder = null): string
	{
		if (!$this->checkSafeUrlService->checkSafe($originalUrl)) {
			throw new UrlUnsafeException();
		}

		$hash = $this->hashUrlService->hash($originalUrl . ($folder ?? ''));
		if (!$this->isHashStored($hash)) {
			$attributes = [
				'hash' => $hash,
				'originalUrl' => $originalUrl
			];
			if ($folder) {
				$attributes['folder'] = $folder;
			}
			$this->repository->add(new HashedUrl($attributes));
		}
		return $this->hostName . ($folder ? "/${folder}" : "") . '/' . $hash;
	}

	private function isHashStored(string $hash): bool
	{
		return $this->repository->findByHash($hash) !== null;
	}
}