<?php

namespace App\Rules;

class EmailRule
{
    public static function rules(): array
    {
        return [
            'required',
            'string',
            'email',
            'max:125',
        ];
    }
}
