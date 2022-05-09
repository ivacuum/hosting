<?php namespace App\Scope;

use App\Domain\FileStatus;
use Illuminate\Database\Eloquent\Builder;

class FilePublishedScope
{
    public function __invoke(Builder $query)
    {
        $query->where('status', FileStatus::Published);
    }
}
