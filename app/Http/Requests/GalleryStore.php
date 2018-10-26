<?php namespace App\Http\Requests;

use Ivacuum\Generic\Http\FormRequest;

class GalleryStore extends FormRequest
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
                'mimetypes:image/gif,image/jpeg,image/png',
                'max:6144',
            ],
        ];
    }
}
