<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\HashedUrl;

class HashedUrlRepository
{
	public function find(int $id): HashedUrl
	{
		return HashedUrl::findOrFail($id);
	}

	public function findByHash(string $hash): ?HashedUrl
	{
		return HashedUrl::where(['hash' => $hash])->first();
	}

	public function findAll()
	{
		return HashedUrl::all();
	}

	public function add(HashedUrl $hashedUrl): void
	{
		$hashedUrl->saveOrFail();
	}

	public function remove(HashedUrl $hashedUrl): void
	{
		$hashedUrl->deleteOrFail();
	}

	public function update(HashedUrl $hashedUrl): void
	{
		$hashedUrl->updateOrFail();
	}
}