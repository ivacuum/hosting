<?php

namespace App\Http\Requests;

use App\Rules\Email;
use App\Rules\HtmlFormInfrastructureRules;
use Illuminate\Foundation\Http\FormRequest;

class CouponFirstvdsForm extends FormRequest
{
    public readonly string $email;

    public function rules(): array
    {
        return [
            ...HtmlFormInfrastructureRules::rules(),
            'email' => Email::rules(),
        ];
    }

    #[\Override]
    protected function passedValidation(): void
    {
        $this->email = $this->input('email');
    }
}
