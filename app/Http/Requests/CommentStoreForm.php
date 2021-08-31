<?php namespace App\Http\Requests;

use App\Rules\Email;
use Illuminate\Validation\Rule;

class CommentStoreForm extends AbstractForm
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'integer|min:1',
            'text' => 'required|max:1000',
            'type' => 'in:news,torrent,trip',
            'email' => Rule::when($this->isGuest(), Email::rules()),
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
