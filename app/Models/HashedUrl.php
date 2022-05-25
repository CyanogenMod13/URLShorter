<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string hash
 * @property string|null folder
 * @property string originalUrl
 */
class HashedUrl extends Model
{
    use HasFactory;

	protected $fillable = [
		'hash', 'folder', 'originalUrl'
	];

	public static function createHahsedUrl(string $originalUrl, string $hash, ?string $folder = null): HashedUrl
	{
		return self::create([
			'hash' => $hash,
			'originalUrl' => $originalUrl,
			'folder' => $folder
		]);
	}
}
