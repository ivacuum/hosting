<?php

namespace App\Livewire\Acp;

use App\Domain\CommentStatus;
use App\Livewire\WithGoto;
use App\Models\Comment;
use Livewire\Attributes\Authorize;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CommentForm extends Component
{
    use WithGoto;

    public Comment $comment;

    #[Locked]
    public int $id;

    #[Validate('required')]
    public string|null $html = '';

    #[Validate('required')]
    public CommentStatus $status = CommentStatus::Published;

    public function mount(): void
    {
        if ($this->id) {
            $this->comment = Comment::query()->findOrFail($this->id);

            $this->html = $this->comment->html;
            $this->status = $this->comment->status;
        }
    }

    #[Authorize('update', 'comment')]
    public function submit()
    {
        $this->validate();
        $this->store();

        return redirect()->to($this->goto ?? to('acp/comments'));
    }

    private function store(): void
    {
        $this->comment->html = $this->html;
        $this->comment->status = $this->status;
        $this->comment->save();
    }
}
