<?php

namespace App\Domain\Wanikani\Cast;

use App\Domain\Wanikani\VocabularyAudio;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class VocabularyAudioCast implements CastsAttributes
{
    #[\Override]
    public function get($model, string $key, $value, array $attributes)
    {
        if ($value === null) {
            return null;
        }

        return new VocabularyAudio($value);
    }

    #[\Override]
    public function set($model, string $key, $value, array $attributes)
    {
        if ($value instanceof VocabularyAudio) {
            return $value->slug;
        }

        return $value;
    }
}
