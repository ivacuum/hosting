<?php

namespace App\Http\Requests\Auth;

use App\Rules\Email;
use App\Rules\Password;
use Illuminate\Foundation\Http\Attributes\FailOnUnknownFields;
use Illuminate\Foundation\Http\FormRequest;

#[FailOnUnknownFields(false)]
class ResetPasswordForm extends FormRequest
{
    public readonly string $email;
    public readonly string $password;
    public readonly string $token;

    public function rules(): array
    {
        return [
            'token' => ['required'],
            'email' => Email::rules(),
            'password' => Password::rules(),
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
