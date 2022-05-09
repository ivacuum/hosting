<?php namespace App\Http\Livewire\Acp;

use App\Comment;
use App\Http\Livewire\WithGoto;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class CommentForm extends Component
{
    use AuthorizesRequests;
    use WithGoto;

    public Comment $comment;

    public function rules()
    {
        return [
            'comment.html' => 'required',
            'comment.status' => 'required',
        ];
    }

    public function submit()
    {
        $this->authorize('update', $this->comment);
        $this->validate();
        $this->comment->save();

        return redirect()->to($this->goto ?? to('acp/comments'));
    }
}
