<?php

namespace App\Http\Requests\Auth;

use App\Rules\EmailRule;
use App\Rules\HtmlFormInfrastructureRules;
use App\Rules\PasswordRule;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordForm extends FormRequest
{
    public readonly string $email;
    public readonly string $password;
    public readonly string $token;

    public function rules(): array
    {
        return [
            ...HtmlFormInfrastructureRules::rules(),
            'token' => ['required'],
            'email' => EmailRule::rules(),
            'password' => PasswordRule::rules(),
        ];
    }

    #[\Override]
    protected function passedValidation(): void
    {
        $this->email = $this->input('email');
        $this->token = $this->input('token');
        $this->password = $this->input('password');
    }
}
