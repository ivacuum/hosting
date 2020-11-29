<?php namespace App\Http\Requests;

use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class MyAvatarUpdateForm extends AbstractRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function avatar()
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
                'mimetypes:image/jpeg,image/png',
                'max:3072',
            ],
        ];
    }
}
