<?php

namespace App\Rules;

class UsernameRule
{
    public static function rules(): array
    {
        return [
            'min:2',
            'max:32',
            'alpha_dash',
        ];
    }
}
