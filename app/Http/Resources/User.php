<?php namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

/**
 * @mixin \App\User
 */
class User extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'color' => \ViewHelper::avatarBg($this->id),
            'avatar' => $this->avatarUrl(),
            'avatar_text' => $this->avatarName(),
            'public_name' => $this->publicName(),
        ];
    }
}
