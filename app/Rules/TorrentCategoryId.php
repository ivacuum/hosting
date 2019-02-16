<?php namespace App\Rules;

use Illuminate\Validation\Rule;

class TorrentCategoryId
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
