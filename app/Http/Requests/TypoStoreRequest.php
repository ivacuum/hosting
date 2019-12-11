<?php namespace App\Http\Requests;

use Ivacuum\Generic\Http\FormRequest;

class TypoStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'selection' => [
                'required',
                'string',
                'min:3',
                'max:200',
            ],
        ];
    }
}
