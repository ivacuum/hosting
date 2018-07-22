<?php namespace App\Http\Resources\Acp;

use Illuminate\Http\Resources\Json\Resource;

/**
 * @mixin \App\Issue
 */
class Issue extends Resource
{
    public function toArray($request)
    {
        /* @var \App\User $me */
        $me = $request->user();

        return [
            'id' => $this->id,
            'page' => $this->page,
            'text' => $this->text,
            'email' => $this->email,
            'title' => $this->title,
            'status' => $this->status,
            'breadcrumb' => $this->breadcrumb(),
            'created_at' => \ViewHelper::dateShort($this->created_at),

            'show_url' => $this->when($me->can('show', 'App\Issue'), path('Acp\Issues@show', $this)),
            'user_url' => $this->when($me->can('show', 'App\User'), path('Acp\Users@show', $this->user_id)),

            'user' => $this->relationLoaded('user') ? $this->user : null,
        ];
    }
}
