<?php

namespace App\Livewire\Acp;

use App\Comment;
use App\Domain\CommentStatus;
use App\Livewire\WithGoto;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CommentForm extends Component
{
    use AuthorizesRequests;
    use WithGoto;

    #[Locked]
    public int $id;

    #[Rule('required')]
    public string|null $html = '';

    #[Rule('required')]
    public CommentStatus|string|null $status = CommentStatus::Published;

    public function mount()
    {
        if ($this->id) {
            $comment = Comment::findOrFail($this->id);

            $this->html = $comment->html;
            $this->status = $comment->status;
        }
    }

    public function submit()
    {
        $comment = Comment::findOrFail($this->id);

        $this->authorize('update', $comment);
        $this->validate();
        $this->store($comment);

        return redirect()->to($this->goto ?? to('acp/comments'));
    }

    private function store(Comment $comment)
    {
        $comment->html = $this->html;
        $comment->status = $this->status;
        $comment->save();
    }
}
