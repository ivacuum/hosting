<?php namespace App\Http\Requests;

use App\Rules\Email;
use Illuminate\Validation\Rule;

class IssueStoreForm extends AbstractForm
{
    public function authorize(): bool
    {
        return $this->expectsJson();
    }

    public function email()
    {
        return $this->input('email');
    }

    public function name()
    {
        return $this->input('name');
    }

    public function pathFromUrl(): string
    {
        $locale = $this->server->get('LARAVEL_LOCALE') ?? '';
        $parsed = parse_url($this->session()->previousUrl());

        $path = $parsed['path'] ?? '';
        $query = isset($parsed['query']) ? "?{$parsed['query']}" : '';
        $localeUri = $locale ? "/{$locale}" : '';

        return $localeUri . $path . $query;
    }

    public function rules(): array
    {
        return [
            'name' => Rule::when(!$this->expectsJson(), 'required'),
            'text' => ['required', 'string', 'max:1000'],
            'email' => Email::rules(),
            'title' => Rule::when(!$this->expectsJson(), 'required'),
        ];
    }

    public function sanitize(array $data): array
    {
        if (isset($data['text']) && $data['text']) {
            $data['text'] = e($data['text']);
        }

        return $data;
    }

    public function text()
    {
        return $this->input('text');
    }

    public function title()
    {
        return $this->input('title');
    }
}
