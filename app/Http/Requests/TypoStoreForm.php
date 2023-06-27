<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypoStoreForm extends FormRequest
{
    public readonly string $selection;
    public readonly string|null $page;

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

    protected function passedValidation()
    {
        $this->page = $this->session()->previousUrl();
        $this->selection = $this->input('selection');
    }
}
