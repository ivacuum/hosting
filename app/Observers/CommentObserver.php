<?php

namespace App\Observers;

use App\Comment;
use App\Domain\CommentStatus;
use App\Events\CommentPublished;
use App\Mail\CommentConfirmMail;
use Illuminate\Support\Str;

class CommentObserver
{
    public function created(Comment $comment)
    {
        if ($comment->status->isPending()) {
            \Mail::to($comment->user)
                ->send(new CommentConfirmMail($comment));
        }

        event(new \App\Events\Stats\CommentAdded);
    }

    public function saved(Comment $comment)
    {
        if ($comment->isDirty('status')) {
            if ($this->wasPending($comment) && $comment->status->isPublished()) {
                event(new CommentPublished($comment));
            }
        }
    }

    public function saving(Comment $comment)
    {
        if ($comment->isDirty('status')) {
            /** @var CommentStatus $was */
            $was = $comment->getOriginal('status');

            if ($was?->isPending() && $comment->status->isPublished()) {
                $comment->created_at = now();
            }
        }

        $this->maintainConsistency($comment);
    }

    private function maintainConsistency(Comment $comment): void
    {
        $comment->html = Str::trim($comment->html);
    }

    private function wasPending(Comment $comment): bool
    {
        return in_array(
            $comment->getOriginal('status'),
            [null, CommentStatus::Pending],
            true
        );
    }
}
