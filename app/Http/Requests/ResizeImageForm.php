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
            'extension' => [
                'required',
                Rule::in(['jpg', 'png']),
            ],
        ];
    }

    #[\Override]
    protected function failedValidation(Validator $validator)
    {
        if ($validator->failed()['extension']) {
            abort(422);
        }

        parent::failedValidation($validator);
    }

    #[\Override]
    protected function passedValidation()
    {
        $this->image = "https://{$this->route('domain')}/{$this->route('path')}";

        // От 50 до 2000px
        $this->width = min(2000, max(50, $this->route('width')));
        $this->height = min(2000, max(50, $this->route('height')));

        $this->extension = pathinfo($this->image)['extension'] ?? null;
    }

    #[\Override]
    protected function prepareForValidation()
    {
        $this->merge([
            'extension' => pathinfo($this->route('path'), PATHINFO_EXTENSION),
        ]);
    }

    private function isWhitelisted(array $whitelist, string|null $domain): bool
    {
        if ($domain === null) {
            return false;
        }

        return array_any($whitelist, fn ($site) => $domain === $site);
    }
}
