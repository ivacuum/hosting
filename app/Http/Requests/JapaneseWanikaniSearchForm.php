<?php namespace App\Http\Requests;

use Ivacuum\Generic\Http\FormRequest;

class JapaneseWanikaniSearchForm extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return ['q' => ['required', 'string', 'min:3']];
    }
}
