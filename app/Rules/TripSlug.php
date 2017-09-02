<?php namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TripSlug implements Rule
{
    public function passes($attribute, $value)
    {
        if (!is_string($value) && !is_numeric($value)) {
            return false;
        }

        return preg_match('/^[\pL\pM\pN\._-]+$/u', $value) > 0;
    }

    public function message()
    {
        return 'Поле может содержать лишь буквы, цифры, дефис, точку и нижнее подчеркивание.';
    }
}
