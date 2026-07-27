<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SignInIndexForm extends FormRequest
{
    public readonly string|null $goto;

    public function rules(): array
    {
        return [];
    }

    #[\Override]
    protected function passedValidation(): void
    {
        $this->goto = $this->input('goto');
    }
}
