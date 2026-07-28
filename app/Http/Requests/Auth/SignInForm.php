<?php

namespace App\Http\Requests\Auth;

use App\Rules\HtmlFormInfrastructureRules;
use Illuminate\Foundation\Http\FormRequest;

class SignInForm extends FormRequest
{
    public readonly string $password;
    public readonly string $emailOrLogin;

    public function rules(): array
    {
        return [
            ...HtmlFormInfrastructureRules::rules(),
            'email' => ['required', 'string'], // Можно ввести и почту, и логин
            'password' => ['required', 'string'],
        ];
    }

    #[\Override]
    protected function passedValidation(): void
    {
        $this->password = $this->input('password');
        $this->emailOrLogin = $this->input('email');
    }
}
