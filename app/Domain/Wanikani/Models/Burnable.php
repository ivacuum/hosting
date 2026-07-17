<?php

namespace App\Domain\Wanikani\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutIncrementing;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
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
#[Table(key: null)]
#[WithoutIncrementing]
#[WithoutTimestamps]
class Burnable extends Model
{
    #[\Override]
    protected function casts(): array
    {
        return [
            'rel_id' => 'int',
            'user_id' => 'int',
        ];
    }
}
