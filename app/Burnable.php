<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Сожженный ключ, кандзи или словарное слово
 *
 * @property int $user_id
 * @property string $rel_type
 * @property int $rel_id
 *
 * @mixin \Eloquent
 */
class Burnable extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey;
    protected $fillable = ['user_id'];
    protected $perPage = 50;

    #[\Override]
    protected function casts(): array
    {
        return [
            'rel_id' => 'int',
            'user_id' => 'int',
        ];
    }
}
