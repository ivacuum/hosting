<?php

namespace App\Cast;

use App\Domain\VocabularyAudio;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class VocabularyAudioCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        if ($value === null) {
            return null;
        }

        return new VocabularyAudio($value);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        if ($value instanceof VocabularyAudio) {
            return $value->slug;
        }

        return $value;
    }
}
