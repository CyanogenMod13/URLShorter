<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Exceptions\UrlUnsafeException;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShortUrlRequest;
use App\Service\UrlShortGeneratorService;
use GuzzleHttp\Exception\GuzzleException;

class UrlShorterController extends Controller
{
	public function __construct(
		private UrlShortGeneratorService $generatorService
	) {}

	/**
	 * @throws UrlUnsafeException
	 * @throws GuzzleException
	 */
	public function generateShortUrl(ShortUrlRequest $request): array
	{
		return ["shortUrl" => $this->generatorService->generateShortUrl($request->originalUrl, $request->folder)];
	}
}