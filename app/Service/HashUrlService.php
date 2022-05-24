<?php

declare(strict_types=1);

namespace App\Service;

class HashUrlService
{
	public function hash(string $url): string
	{
		return substr(base64_encode(hash('sha256', $url)), 0, 6);
	}
}