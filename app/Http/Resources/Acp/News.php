<?php namespace App\Http\Resources\Acp;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\News */
class News extends JsonResource
{
    public function toArray($request)
    {
        /** @var \App\User $me */
        $me = $request->user();
        $foreignKey = [$this->getForeignKey() => $this->id];

        return [
            'id' => $this->id,
            'www' => $this->www(),
            'title' => $this->title,
            'views' => $this->views,
            'status' => $this->status,
            'breadcrumb' => $this->breadcrumb(),

            'edit_url' => $this->when($me->can('edit', 'App\News'), path(['App\Http\Controllers\Acp\News', 'edit'], $this)),
            'show_url' => $this->when($me->can('show', 'App\News'), path(['App\Http\Controllers\Acp\News', 'show'], $this)),
            'user_url' => $this->when(
                $me->can('show', 'App\User'),
                path(['App\Http\Controllers\Acp\Users', 'show'], $this->user_id)
            ),
            'comments_url' => $this->when(
                $me->can('list', 'App\Comment'),
                path(['App\Http\Controllers\Acp\Comments', 'index'], $foreignKey)
            ),

            'comments_count' => (int) $this->comments_count,

            'user' => $this->relationLoaded('user') ? new User($this->user) : null,
        ];
    }
}
