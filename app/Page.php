<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $title
 * @property string $url
 */
class Page extends Model
{
    protected $hidden = ['left_id', 'right_id', 'depth'];
    protected $guarded = ['id', 'parent_id', 'left_id', 'right_id', 'depth'];

    public function breadcrumb()
    {
        return "{$this->title} {$this->url}";
    }
}
