<?php namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Comment */
class Comment extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'html' => $this->html,
            'user_id' => $this->user_id,
            'posted_at' => $this->fullDate(),

            'user' => $this->whenLoaded('user', new User($this->user)),
        ];
    }
}
