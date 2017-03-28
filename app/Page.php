<?php namespace App;

use Baum\Node;
use Illuminate\Database\Eloquent\Builder;

class Page extends Node
{
    protected $hidden = ['left_id', 'right_id', 'depth'];
    protected $guarded = ['id', 'parent_id', 'left_id', 'right_id', 'depth'];

    protected $leftColumn = 'left_id';
    protected $rightColumn = 'right_id';

    public function scopeActive(Builder $query)
    {
        return $query->where('active', 1);
    }

    public function breadcrumb()
    {
        return "{$this->title} {$this->url}";
    }
}
