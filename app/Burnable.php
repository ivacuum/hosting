<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Сожженный ключ, кандзи или словарное слово
 *
 * @property integer $user_id
 * @property integer $rel_type
 * @property integer $rel_id
 *
 * @mixin \Eloquent
 */
class Burnable extends Model
{
    protected $fillable = ['user_id'];
    protected $perPage = 50;

    public $timestamps = false;
}
