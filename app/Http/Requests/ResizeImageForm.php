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

    private string|null $extension;

    public function authorize(GetResizeImageWhitelistAction $getResizeImageWhitelist): bool
    {
        return $this->isWhitelisted(
            $getResizeImageWhitelist->execute(),
            $this->input('dirname')
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
            'dirname' => 'required',
            'extension' => [
                'required',
                Rule::in(['jpg', 'png']),
            ],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($validator->failed()['extension']) {
            abort(422);
        }

        parent::failedValidation($validator);
    }

    protected function passedValidation()
    {
        $this->image = $this->input('image');

        // От 50 до 2000px
        $this->width = min(2000, max(50, $this->route('width')));
        $this->height = min(2000, max(50, $this->route('height')));

        $this->extension = pathinfo($this->image)['extension'] ?? null;

        abort_unless($this->extension, 422);
    }

    protected function prepareForValidation()
    {
        abort_unless($this->input('image'), 404);

        $info = pathinfo($this->input('image'));

        $this->merge([
            'dirname' => $info['dirname'] ?? null,
            'extension' => $info['extension'] ?? null,
        ]);
    }

    private function isWhitelisted(array $whitelist, string|null $uri): bool
    {
        if ($uri === null) {
            return false;
        }

        // Слэш для корневой папки
        $uri = rtrim($uri, '/') . '/';

        foreach ($whitelist as $site) {
            if (str_starts_with($uri, $site)) {
                return true;
            }
        }

        return false;
    }
}
