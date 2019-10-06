<?php namespace App\Http\Resources\Acp;

use Illuminate\Http\Resources\Json\Resource;

/**
 * @mixin \App\Comment
 */
class Comment extends Resource
{
    public function toArray($request)
    {
        /** @var \App\User $me */
        $me = $request->user();

        return [
            'id' => $this->id,
            'html' => $this->html,
            'status' => $this->status,
            'posted_at' => $this->fullDate(),
            'breadcrumb' => $this->breadcrumb(),
            'created_at' => \ViewHelper::dateShort($this->created_at),

            'show_url' => $this->when($me->can('show', 'App\Comment'), path('Acp\Comments@show', $this)),
            'user_url' => $this->when($me->can('show', 'App\User'), path('Acp\Users@show', $this->user_id)),

            'user' => $this->relationLoaded('user') ? new User($this->user) : null,
        ];
    }
}
