<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string originalUrl
 * @property string|null folder
 */
class ShortUrlRequest extends FormRequest
{
    public function rules()
    {
        return [
            'originalUrl' => 'string',
			'folder' => 'string'
        ];
    }
}
