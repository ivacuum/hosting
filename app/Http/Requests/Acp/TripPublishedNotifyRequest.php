<?php namespace App\Http\Requests\Acp;

use Ivacuum\Generic\Http\FormRequest;

class TripPublishedNotifyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => 'required|date|after:now',
        ];
    }
}
