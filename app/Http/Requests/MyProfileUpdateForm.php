<?php

namespace App\Http\Requests;

use App\Rules\EmailRule;
use App\Rules\HtmlFormInfrastructureRules;
use App\Rules\UsernameRule;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MyProfileUpdateForm extends FormRequest
{
    public User $user;
    public readonly string $email;
    public readonly string|null $username;

    public function rules(): array
    {
        $user = $this->user();

        return [
            ...HtmlFormInfrastructureRules::rules(),
            'email' => [
                ...EmailRule::rules(),
                Rule::unique(User::class)->ignore($user),
            ],
            'username' => [
                'nullable',
                ...UsernameRule::rules(),
                Rule::unique(User::class, 'login')->ignore($user),
            ],
        ];
    }

    #[\Override]
    protected function passedValidation()
    {
        $this->user = $this->user();
        $this->email = $this->input('email');
        $this->username = $this->input('username');
    }
}
