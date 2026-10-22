<?php

namespace App\Scope;

use App\Domain\CommentStatus;
use Illuminate\Database\Eloquent\Builder;

class CommentPublishedScope
{
    public function __invoke(Builder $query): void
    {
        $query->where('status', CommentStatus::Published);
    }
}
