<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule;

class NotRandomTokenRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        $text = trim($value);

        if (!preg_match('/\A[a-zA-Z]{16,}\z/', $text)) {
            return;
        }

        if (preg_match_all('/[A-Z]/', $text) >= 4 && preg_match_all('/[a-z]/', $text) >= 4) {
            $fail('validation.not_random_token')->translate();
        }
    }
}
