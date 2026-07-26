<?php

namespace App\Http\Requests;

use App\Action\GetResizeImageWhitelistAction;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ResizeImageForm extends FormRequest
{
    public int $width;
    public int $height;
    public string $image;

    private string|null $extension = null;

    public function authorize(GetResizeImageWhitelistAction $getResizeImageWhitelist): bool
    {
        return $this->isWhitelisted(
            $getResizeImageWhitelist->execute(),
            $this->route('domain')
        );
    }

    public function mimeByExtension(): string
    {
        return match ($this->extension) {
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            default => 'image',
        };
    }

    public function rules(): array
    {
        return [
            'width' => ['required', 'integer', 'min:50', 'max:2000'],
            'height' => ['required', 'integer', 'min:50', 'max:2000'],
            'extension' => [
                'required',
                Rule::in(['jpg', 'png']),
            ],
        ];
    }

    #[\Override]
    protected function failedValidation(Validator $validator): never
    {
        abort(422);
    }

    #[\Override]
    protected function passedValidation(): void
    {
        $this->image = "https://{$this->route('domain')}/{$this->route('path')}";
        $this->width = $this->integer('width');
        $this->height = $this->integer('height');
        $this->extension = $this->input('extension');
    }

    #[\Override]
    protected function prepareForValidation(): void
    {
        $this->merge([
            'width' => $this->route('width'),
            'height' => $this->route('height'),
            'extension' => pathinfo($this->route('path'), PATHINFO_EXTENSION),
        ]);
    }

    private function isWhitelisted(array $whitelist, string|null $domain): bool
    {
        if ($domain === null) {
            return false;
        }

        return array_any($whitelist, static fn ($site) => $domain === $site);
    }
}
