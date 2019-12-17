<?php namespace App\Http\Requests;

use Ivacuum\Generic\Http\FormRequest;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class GalleryStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function image()
    {
        $file = $this->file('file');

        if (null === $file || !$file->isValid()) {
            throw new UnprocessableEntityHttpException('Необходимо предоставить хотя бы один файл');
        }

        return $file;
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
