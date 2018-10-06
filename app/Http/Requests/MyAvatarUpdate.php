<?php namespace App\Http\Requests;

use Ivacuum\Generic\Http\FormRequest;

class MyAvatarUpdate extends FormRequest
{
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
