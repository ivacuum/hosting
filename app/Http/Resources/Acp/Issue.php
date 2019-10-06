<?php namespace App\Http\Resources\Acp;

use Illuminate\Http\Resources\Json\Resource;

/**
 * @mixin \App\Issue
 */
class Issue extends Resource
{
    public function toArray($request)
    {
        /** @var \App\User $me */
        $me = $request->user();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'page' => $this->page,
            'text' => $this->text,
            'email' => $this->email,
            'title' => $this->title,
            'status' => $this->status,
            'breadcrumb' => $this->breadcrumb(),
            'created_at' => \ViewHelper::dateShort($this->created_at),

            'show_url' => $this->when(
                $me->can('show', 'App\Issue'),
                path(['App\Http\Controllers\Acp\Issues', 'show'], $this)
            ),
            'user_url' => $this->when(
                $me->can('show', 'App\User'),
                path(['App\Http\Controllers\Acp\Users', 'show'], $this->user_id)
            ),

            'comments_count' => (int) $this->comments_count,

            'user' => $this->relationLoaded('user') ? new User($this->user) : null,
            'comments' => $this->relationLoaded('comments') ? new CommentCollection($this->comments) : null,
        ];
    }
}
