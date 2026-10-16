<?php

namespace App\Http\Requests\Auth;

use App\Rules\HtmlFormInfrastructureRules;
use Illuminate\Foundation\Http\FormRequest;

class SignInForm extends FormRequest
{
    public readonly string $password;
    public readonly string $emailOrLogin;
    public readonly bool $remember;

    public function rules(): array
    {
        return [
            ...HtmlFormInfrastructureRules::rules(),
            'email' => ['required', 'string'], // Можно ввести и почту, и логин
            'password' => ['required', 'string'],
            'foreign' => ['sometimes', 'accepted'],
        ];
    }

    #[\Override]
    protected function passedValidation(): void
    {
        $this->password = $this->input('password');
        $this->remember = !$this->boolean('foreign');
        $this->emailOrLogin = $this->input('email');
    }
}
