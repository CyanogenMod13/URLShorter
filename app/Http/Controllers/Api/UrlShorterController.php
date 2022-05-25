<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Exceptions\UrlUnsafeException;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShortUrlRequest;
use App\Service\UrlShortGeneratorService;
use Illuminate\Http\JsonResponse;
use Throwable;

class UrlShorterController extends Controller
{
	public function __construct(
		private UrlShortGeneratorService $generatorService
	) {}

	public function generateShortUrl(ShortUrlRequest $request): JsonResponse|array
	{
		try {
			return response()->json([
				"shortUrl" => $this->generatorService->generateShortUrl($request->originalUrl, $request->folder)
			]);
		} catch (UrlUnsafeException $e) {
			return response()->json(['message' => $e->getMessage()], 400);
		} catch (Throwable $e) {
			return response()->json(['message' => 'Something went wrong'], 500);
		}
	}
}