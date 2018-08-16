<?php namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

/**
 * @mixin \App\Radical
 */
class Radical extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image' => $this->image,
            'level' => $this->level,
            'burned' => $this->relationLoaded('burnable') ? null !== $this->burnable : false,
            'meaning' => $this->meaning,
            'character' => $this->character,
        ];
    }
}
