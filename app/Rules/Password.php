<?php

namespace App\Rules;

class Password
{
    public static function rules(): array
    {
        return [
            'required',
            'string',
            'min:8',
        ];
    }
}
