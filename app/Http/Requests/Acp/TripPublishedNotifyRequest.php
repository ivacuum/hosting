<?php namespace App\Http\Requests\Acp;

use Carbon\CarbonImmutable;
use Ivacuum\Generic\Http\FormRequest;

class TripPublishedNotifyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function date(): CarbonImmutable
    {
        return CarbonImmutable::parse($this->input('date'));
    }

    public function rules(): array
    {
        return [
            'date' => 'required|date|after:now',
        ];
    }
}
