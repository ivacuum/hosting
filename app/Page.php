<?php namespace App;

use Baum\Node;

class Page extends Node
{
    protected $hidden = ['left_id', 'right_id', 'depth'];
    protected $guarded = ['id', 'parent_id', 'left_id', 'right_id', 'depth'];

    protected $leftColumn = 'left_id';
    protected $rightColumn = 'right_id';

    public function breadcrumb()
    {
        return "{$this->title} {$this->url}";
    }
}
