<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\Attributes\FailOnUnknownFields;
use Illuminate\Foundation\Http\FormRequest;

#[FailOnUnknownFields(false)]
class SignInForm extends FormRequest
{
    public readonly string $password;
    public readonly string $emailOrLogin;

    public function rules(): array
    {
        return [
            // Можно ввести и почту, и логин
            'email' => ['required', 'string'],
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
