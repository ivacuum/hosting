<?php

namespace App\Rules;

class HtmlFormInfrastructureRules
{
    public static function rules(): array
    {
        return [
            '_method' => ['nullable'], // blade's @method
            '_token' => ['nullable'], // csrf_token()
            'mail' => ['nullable'], // honeypot
        ];
    }
}
