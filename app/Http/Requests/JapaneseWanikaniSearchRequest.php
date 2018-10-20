<?php namespace App\Http\Requests;

use Ivacuum\Generic\Http\FormRequest;

class JapaneseWanikaniSearchRequest extends FormRequest
{
    public function rules(): array
    {
        return ['q' => ['required', 'string', 'min:3']];
    }
}
