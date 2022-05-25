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
		$attributes = [
			'hash' => $hash,
			'originalUrl' => $originalUrl
		];
		if ($folder) {
			$attributes['folder'] = $folder;
		}
		return self::create($attributes);
	}
}
