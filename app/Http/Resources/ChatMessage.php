<?php namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

/**
 * @mixin \App\ChatMessage
 */
class ChatMessage extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => $this->created_at->toDateString(),
            'time' => $this->created_at->format('H:i'),
            'html' => $this->html,
            'user' => $this->relationLoaded('user') ? new User($this->user) : null,
        ];
    }
}
