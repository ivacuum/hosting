<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WanikaniKanjiIndexForm extends FormRequest
{
    public readonly int $to;
    public readonly int $from;

    public function rules(): array
    {
        return [];
    }

    #[\Override]
    protected function passedValidation(): void
    {
        $this->from = max(1, min(60, $this->integer('from', 1)));
        $this->to = min(60, $this->from + 9);
    }
}
