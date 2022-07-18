<?php namespace App\Rules;

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
