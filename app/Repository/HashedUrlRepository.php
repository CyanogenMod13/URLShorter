<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\HashedUrl;

class HashedUrlRepository
{
	public function findByHash(string $hash): ?HashedUrl
	{
		return HashedUrl::where(['hash' => $hash])->first();
	}

	public function isHashExists(string $hash): bool
	{
		return HashedUrl::where(['hash' => $hash])->exists();
	}
}