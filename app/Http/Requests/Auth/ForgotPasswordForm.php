<?php

namespace App\Http\Requests\Auth;

use App\Rules\Email;
use Illuminate\Foundation\Http\Attributes\FailOnUnknownFields;
use Illuminate\Foundation\Http\FormRequest;

#[FailOnUnknownFields(false)]
class ForgotPasswordForm extends FormRequest
{
    public readonly string $email;

    public function rules(): array
    {
        return [
            'email' => Email::rules(),
        ];
    }

    #[\Override]
    protected function passedValidation(): void
    {
        $this->email = $this->input('email');
    }
}
