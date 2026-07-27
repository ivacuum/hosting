<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\Attributes\FailOnUnknownFields;
use Illuminate\Foundation\Http\FormRequest;

#[FailOnUnknownFields(false)]
class FacebookRedirectForm extends FormRequest
{
    public readonly bool $shouldRerequest;
    public readonly string|null $goto;

    public function rules(): array
    {
        return [];
    }

    #[\Override]
    protected function passedValidation(): void
    {
        $this->goto = $this->input('goto');
        $this->shouldRerequest = $this->boolean('rerequest');
    }
}
