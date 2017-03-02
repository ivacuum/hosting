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
 */
class Artist extends Model
{
    protected $guarded = ['created_at', 'updated_at', 'goto'];
}
