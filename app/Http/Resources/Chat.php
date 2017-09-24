<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Chat extends Resource
{
    public function toArray($request)
    {
        /* @var \App\ChatMessage $this */
        return [
            'id' => $this->id,
            'date' => $this->created_at->toDateString(),
            'time' => $this->created_at->toTimeString(),
            'html' => $this->html,
            'author' => $this->relationLoaded('user')
                ? $this->user->publicName()
                : optional($request->user())->publicName(),
        ];
    }
}
