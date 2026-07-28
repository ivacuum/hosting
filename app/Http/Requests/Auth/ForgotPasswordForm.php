<?php

namespace App\Http\Requests\Auth;

use App\Rules\EmailRule;
use App\Rules\HtmlFormInfrastructureRules;
use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordForm extends FormRequest
{
    public readonly string $email;

    public function rules(): array
    {
        return [
            ...HtmlFormInfrastructureRules::rules(),
            'email' => EmailRule::rules(),
        ];
    }

    #[\Override]
    protected function passedValidation(): void
    {
        $this->email = $this->input('email');
    }
}
