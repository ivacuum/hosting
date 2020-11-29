<?php namespace App\Http\Requests;

use Ivacuum\Generic\Http\FormRequest;

class TypoStoreForm extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function page()
    {
        return $this->session()->previousUrl();
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

    public function selection()
    {
        return $this->input('selection');
    }
}
