<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repository\HashedUrlRepository;

class UrlRedirectController extends Controller
{
	public function __construct(
		private HashedUrlRepository $repository
	) {}

	public function index(string $hash, ?string $folder = null)
	{
		$hashedUrl = $this->repository->findByHash($hash);
		if ($hashedUrl && $hashedUrl->folder === $folder) {
			return redirect($hashedUrl->originalUrl);
		}
		return redirect('/notfound');
	}
}