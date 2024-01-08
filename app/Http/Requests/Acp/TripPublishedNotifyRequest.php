<?php

namespace App\Http\Requests\Acp;

use Carbon\CarbonImmutable;
use Illuminate\Foundation\Http\FormRequest;

class TripPublishedNotifyRequest extends FormRequest
{
    public readonly CarbonImmutable $date;

    public function rules(): array
    {
        return [
            'date' => 'required|date|after:now',
        ];
    }

    #[\Override]
    protected function passedValidation()
    {
        $this->date = CarbonImmutable::make($this->input('date'));
    }
}
