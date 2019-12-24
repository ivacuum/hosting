<?php namespace App\Http\Requests;

class ChatStoreRequest extends AbstractRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'text' => ['required', 'string', 'max:1000'],
        ];
    }

    public function text()
    {
        return $this->input('text');
    }
}
