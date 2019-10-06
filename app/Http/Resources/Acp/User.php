<?php namespace App\Http\Resources\Acp;

use Illuminate\Http\Resources\Json\Resource;

/**
 * @mixin \App\User
 */
class User extends Resource
{
    public function toArray($request)
    {
        /** @var \App\User $me */
        $me = $request->user();

        return [
            'id' => $this->id,
            'www' => $this->www(),
            'color' => \ViewHelper::avatarBg($this->id),
            'email' => $this->email,
            'avatar' => $this->avatarUrl(),
            'status' => $this->status,
            'breadcrumb' => $this->breadcrumb(),
            'avatar_text' => $this->avatarName(),
            'public_name' => $this->publicName(),
            'created_at' => \ViewHelper::dateShort($this->created_at),

            'show_url' => $this->when($me->can('show', 'App\User'), path(['App\Http\Controllers\Acp\Users', 'show'], $this)),
        ];
    }
}
