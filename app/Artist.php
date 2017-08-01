<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Артист
 *
 * @property integer $id
 * @property string  $title
 * @property string  $slug
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @mixin \Eloquent
 */
class Artist extends Model
{
    protected $guarded = ['created_at', 'updated_at', 'goto'];

    public function breadcrumb()
    {
        return $this->title;
    }

    public static function forInputSelect()
    {
        return self::orderBy('title')->get(['id', 'title'])->pluck('title', 'id');
    }
}
