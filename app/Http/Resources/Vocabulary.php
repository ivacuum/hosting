<?php namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Vocabulary */
class Vocabulary extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'kana' => $this->kana,
            'level' => $this->level,
            'burned' => $this->relationLoaded('burnable') ? null !== $this->burnable : false,
            'meaning' => $this->meaning,
            'character' => $this->character,
            'sentences' => $this->sentences,
            'male_audio' => $this->maleAudioMp3(),
            'female_audio' => $this->femaleAudioMp3(),
        ];
    }
}
