<?php namespace App\Rules;

class Username
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
