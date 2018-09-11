<?php namespace App\Http\Requests;

use Ivacuum\Generic\Http\FormRequest;

class ChatStore extends FormRequest
{
    public function authorize(): bool
    {
        return null !== $this->user();
    }

    public function rules(): array
    {
        return [
            'text' => ['required', 'string', 'max:1000'],
        ];
    }
}
