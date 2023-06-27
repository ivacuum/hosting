<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LifeIndexForm extends FormRequest
{
    public readonly string|null $to;
    public readonly string|null $from;

    public function rules(): array
    {
        return [
            'to' => 'nullable|date',
            'from' => 'nullable|date',
        ];
    }

    protected function passedValidation()
    {
        $this->to = $this->input('to');
        $this->from = $this->input('from');
    }
}
