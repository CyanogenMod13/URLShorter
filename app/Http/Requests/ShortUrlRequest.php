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
            'originalUrl' => 'url|required',
			'folder' => 'string|min:6|max:255|nullable|alpha_num'
        ];
    }
}
