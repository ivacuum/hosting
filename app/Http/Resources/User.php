<?php namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\User */
class User extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'www' => $this->www(),
            'color' => \ViewHelper::avatarBg($this->id),
            'avatar' => $this->avatarUrl(),
            'avatar_text' => $this->avatarName(),
            'public_name' => $this->publicName(),
        ];
    }
}
