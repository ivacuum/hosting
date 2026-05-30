<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule;

class AtLeastFewWords implements ValidationRule
{
    public function __construct(public int $minWords) {}

    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        $words = preg_split('/\s+/u', trim($value), -1, PREG_SPLIT_NO_EMPTY);

        if (count($words) < $this->minWords) {
            $fail('validation.at_least_few_words')->translate(['min' => $this->minWords]);
        }
    }
}
