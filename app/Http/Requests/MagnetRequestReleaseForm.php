<?php namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class MagnetRequestReleaseForm extends FormRequest
{
    public User|null $user;
    public readonly string $q;
    public readonly string|null $comment;

    public function rules(): array
    {
        return [
            'query' => 'required|string',
            'comment' => 'string',
        ];
    }

    protected function passedValidation()
    {
        $this->q = $this->input('query');
        $this->user = $this->user();
        $this->comment = $this->input('comment');
    }
}
