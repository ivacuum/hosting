<?php

namespace App\Rules;

class PasswordRule
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
