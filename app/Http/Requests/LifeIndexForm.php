<?php

namespace App\Http\Requests;

use Carbon\CarbonImmutable;
use Illuminate\Foundation\Http\FormRequest;

class LifeIndexForm extends FormRequest
{
    public readonly CarbonImmutable|null $to;
    public readonly CarbonImmutable|null $from;

    public function rules(): array
    {
        return [
            'to' => 'nullable|date',
            'from' => 'nullable|date',
        ];
    }

    #[\Override]
    protected function passedValidation(): void
    {
        $this->to = $this->date('to')?->startOfDay();
        $this->from = $this->date('from')?->startOfDay();
    }
}
