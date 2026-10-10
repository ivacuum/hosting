<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripShowForm extends FormRequest
{
    public readonly string|null $anchor;

    public function rules(): array
    {
        return [
            'anchor' => ['nullable', 'string'],
        ];
    }

    #[\Override]
    protected function passedValidation(): void
    {
        $this->anchor = $this->input('anchor');
    }
}
