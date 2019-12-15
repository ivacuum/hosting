<?php namespace App\Http\Requests;

use Ivacuum\Generic\Http\FormRequest;

class MyAvatarUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file' => [
                'required',
                'mimetypes:image/jpeg,image/png',
                'max:3072',
            ],
        ];
    }
}