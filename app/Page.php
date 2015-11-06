<?php

namespace App;

use Baum\Node;

class Page extends Node
{
    protected $fillable = [
        'parent_id',
        'active',
        'title',
        'url',
        'redirect',
        'text',
        'handler',
        'method',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'noindex',
        'filters_before',
        'filters_after'
    ];
    protected $hidden = ['left_id', 'right_id', 'depth'];
    protected $guarded = ['id', 'parent_id', 'left_id', 'right_id', 'depth'];

    protected $leftColumn = 'left_id';
    protected $rightColumn = 'right_id';

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
