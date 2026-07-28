<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailClickForm extends FormRequest
{
    public readonly string $goto;

    public function rules(): array
    {
        return [];
    }

    #[\Override]
    protected function passedValidation(): void
    {
        $this->goto = $this->input('goto', '/');
    }
}
