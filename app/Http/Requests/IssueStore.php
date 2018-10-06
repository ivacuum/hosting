<?php namespace App\Http\Requests;

use App\Rules\Email;
use Ivacuum\Generic\Http\FormRequest;

class IssueStore extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => $this->ajax() ? '' : 'required',
            'text' => ['required', 'string', 'max:1000'],
            'email' => Email::rules(),
            'title' => $this->ajax() ? '' : 'required',
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
