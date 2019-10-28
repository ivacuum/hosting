<?php namespace App\Http\Requests;

use App\Rules\Email;
use Ivacuum\Generic\Http\FormRequest;

class IssueStore extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => $this->expectsJson() ? '' : 'required',
            'text' => ['required', 'string', 'max:1000'],
            'email' => Email::rules(),
            'title' => $this->expectsJson() ? '' : 'required',
        ];
    }

    public function sanitize(array $data): array
    {
        if (isset($data['text']) && $data['text']) {
            $data['text'] = e($data['text']);
        }

        return $data;
    }
}
