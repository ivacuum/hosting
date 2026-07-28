<?php

namespace App\Http\Requests\Auth;

use App\Rules\EmailRule;
use App\Rules\HtmlFormInfrastructureRules;
use App\Rules\PasswordRule;
use Illuminate\Foundation\Http\FormRequest;

class NewAccountForm extends FormRequest
{
    public readonly string $email;
    public readonly string $password;

    public function rules(): array
    {
        return [
            ...HtmlFormInfrastructureRules::rules(),
            'email' => EmailRule::rules(),
            'password' => PasswordRule::rules(),
        ];
    }

    #[\Override]
    protected function passedValidation(): void
    {
        $this->email = $this->input('email');
        $this->password = $this->input('password');
    }
}
