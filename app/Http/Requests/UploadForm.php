<?php

namespace App\Http\Requests;

use App\Rules\HtmlFormInfrastructureRules;
use Illuminate\Foundation\Http\FormRequest;

class UploadForm extends FormRequest
{
    /** @var array<\Illuminate\Http\UploadedFile>|null */
    public readonly array|null $uploadedFiles;

    public function rules(): array
    {
        return [
            ...HtmlFormInfrastructureRules::rules(),
            'files' => ['required', 'array', 'max:51200'],
        ];
    }

    #[\Override]
    protected function passedValidation(): void
    {
        $this->uploadedFiles = $this->file('files');
    }
}
