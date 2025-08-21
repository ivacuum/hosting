<?php

namespace App\Domain\Magnet\Rule;

use Illuminate\Validation\Rule;

class MagnetCategoryId
{
    public static function rules(): array
    {
        return [
            'required',
            'integer',
            Rule::in(\TorrentCategoryHelper::canPostIds()),
        ];
    }
}
