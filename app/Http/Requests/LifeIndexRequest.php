<?php namespace App\Http\Requests;

class LifeIndexRequest extends AbstractRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function from()
    {
        return $this->input('from');
    }

    public function rules(): array
    {
        return [
            'to' => 'nullable|date',
            'from' => 'nullable|date',
        ];
    }

    public function to()
    {
        return $this->input('to');
    }
}
