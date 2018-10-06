<?php namespace App\Http\Requests;

use App\Rules\Email;
use Ivacuum\Generic\Http\FormRequest;

class CommentStore extends FormRequest
{
    public function rules(): array
    {
        $is_guest = null === $this->user();

        return [
            'id' => 'integer|min:1',
            'text' => 'required|max:1000',
            'type' => 'in:news,torrent,trip',
            'email' => $is_guest ? Email::rules() : '',
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
