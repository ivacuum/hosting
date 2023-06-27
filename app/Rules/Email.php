<?php

namespace App\Rules;

class Email
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
