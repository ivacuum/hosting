<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\Attributes\FailOnUnknownFields;
use Illuminate\Foundation\Http\FormRequest;

#[FailOnUnknownFields(false)]
class GoogleRedirectForm extends FormRequest
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
