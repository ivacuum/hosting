<?php namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Kanji */
class Kanji extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'level' => $this->level,
            'burned' => $this->relationLoaded('burnable') ? null !== $this->burnable : false,
            'onyomi' => $this->katakanaOnyomi(),
            'kunyomi' => $this->kunyomi,
            'meaning' => $this->meaning,
            'reading' => $this->importantReading(),
            'character' => $this->character,
            'first_meaning' => $this->firstMeaning(),
        ];
    }
}
