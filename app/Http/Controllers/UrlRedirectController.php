<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repository\HashedUrlRepository;

class UrlRedirectController extends Controller
{
	public function __construct(
		private HashedUrlRepository $repository
	) {}

	public function index(string $hash)
	{
		$hashedUrl = $this->repository->findByHash($hash);
		if ($hashedUrl) {
			return redirect($hashedUrl->originalUrl);
		} else {
			return redirect('/');
		}
	}

	public function indexFolder(string $folder, string $hash)
	{
		$hashedUrl = $this->repository->findByHash($hash);
		if ($hashedUrl && $hashedUrl->folder === $folder) {
			return redirect($hashedUrl->originalUrl);
		} else {
			return redirect('/');
		}
	}
}