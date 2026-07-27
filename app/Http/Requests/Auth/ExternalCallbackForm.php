<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\Attributes\FailOnUnknownFields;
use Illuminate\Foundation\Http\FormRequest;

#[FailOnUnknownFields(false)]
class ExternalCallbackForm extends FormRequest
{
    public readonly bool $hasError;

    public function rules(): array
    {
        return [];
    }

    #[\Override]
    protected function passedValidation(): void
    {
        $this->hasError = $this->boolean('error');
    }
}
