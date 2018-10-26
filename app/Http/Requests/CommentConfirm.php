<?php namespace App\Http\Requests;

use Ivacuum\Generic\Http\FormRequest;

class CommentConfirm extends FormRequest
{
    public function authorize(): bool
    {
        /** @var \App\User $user */
        /** @var \App\Comment $comment */
        $user = $this->user();
        $comment = $this->route()->parameter('comment');

        return $comment->user_id === $user->id;
    }

    public function rules(): array
    {
        return [];
    }
}
