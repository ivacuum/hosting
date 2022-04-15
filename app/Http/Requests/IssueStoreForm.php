<?php namespace App\Http\Requests;

use App\Rules\Email;
use App\User;
use Illuminate\Validation\Rule;

class IssueStoreForm extends AbstractForm
{
    public ?User $user;
    public readonly string $text;
    public readonly string $email;
    public readonly string $title;
    public readonly ?string $name;

    public function authorize(): bool
    {
        return $this->expectsJson();
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

    protected function passedValidation()
    {
        $this->name = $this->input('name');
        $this->text = $this->input('text');
        $this->user = $this->user();
        $this->email = $this->input('email');
        $this->title = $this->input('title');
    }
}
