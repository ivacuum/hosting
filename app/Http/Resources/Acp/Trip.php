<?php namespace App\Http\Resources\Acp;

use Illuminate\Http\Resources\Json\Resource;

/**
 * @mixin \App\Trip
 */
class Trip extends Resource
{
    public function toArray($request)
    {
        /* @var \App\User $me */
        $me = $request->user();
        $foreign_key = [$this->getForeignKey() => $this->id];

        return [
            'id' => $this->id,
            'www' => $this->www(),
            'slug' => $this->slug,
            'title' => $this->title,
            'views' => $this->views,
            'status' => $this->status,
            'breadcrumb' => $this->breadcrumb(),
            'meta_image' => $this->meta_image ? $this->metaImage() : '',
            'meta_title' => $this->meta_title,
            'localized_date' => $this->localizedDate(),
            'meta_description' => $this->meta_description,

            'edit_url' => $this->when($me->can('edit', 'App\Trip'), path('Acp\Trips@edit', $this)),
            'show_url' => $this->when($me->can('show', 'App\Trip'), path('Acp\Trips@show', $this)),
            'user_url' => $this->when($me->can('show', 'App\User'), path('Acp\Users@show', $this->user_id)),
            'photos_url' => $this->when($me->can('list', 'App\Photo'), path('Acp\Photos@index', $foreign_key)),
            'comments_url' => $this->when($me->can('list', 'App\Comment'), path('Acp\Comments@index', $foreign_key)),
            'template_url' => $this->when($me->isRoot(), path('Acp\Dev\Templates@show', $this->slug)),
            'new_photo_url' => $this->when($me->can('create', 'App\Photo'), path('Acp\Photos@create', $foreign_key)),

            'photos_count' => $this->photos_count,
            'comments_count' => $this->comments_count,

            'user' => $this->relationLoaded('user') ? $this->user : null,
        ];
    }
}
