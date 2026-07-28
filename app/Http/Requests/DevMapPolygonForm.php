<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DevMapPolygonForm extends FormRequest
{
    public readonly string|null $wkt;

    public function rules(): array
    {
        return [];
    }

    #[\Override]
    protected function passedValidation(): void
    {
        $this->wkt = $this->input('wkt');
    }
}
