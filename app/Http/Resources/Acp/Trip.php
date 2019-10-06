<?php namespace App\Http\Resources\Acp;

use Illuminate\Http\Resources\Json\Resource;

/**
 * @mixin \App\Trip
 */
class Trip extends Resource
{
    public function toArray($request)
    {
        /** @var \App\User $me */
        $me = $request->user();
        $foreignKey = [$this->getForeignKey() => $this->id];

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
            'meta_description' => $this->metaDescription(),

            'edit_url' => $this->when($me->can('edit', 'App\Trip'), path(['App\Http\Controllers\Acp\Trips', 'edit'], $this)),
            'show_url' => $this->when($me->can('show', 'App\Trip'), path(['App\Http\Controllers\Acp\Trips', 'show'], $this)),
            'user_url' => $this->when(
                $me->can('show', 'App\User'),
                path(['App\Http\Controllers\Acp\Users', 'show'], $this->user_id)
            ),
            'photos_url' => $this->when(
                $me->can('list', 'App\Photo'),
                path(['App\Http\Controllers\Acp\Photos', 'index'], $foreignKey)
            ),
            'comments_url' => $this->when(
                $me->can('list', 'App\Comment'),
                path(['App\Http\Controllers\Acp\Comments', 'index'], $foreignKey)
            ),
            'template_url' => $this->when(
                $me->isRoot(),
                path(['App\Http\Controllers\Acp\Dev\Templates', 'show'], $this->slug)
            ),
            'new_photo_url' => $this->when(
                $me->can('create', 'App\Photo'),
                path(['App\Http\Controllers\Acp\Photos', 'create'], $foreignKey)
            ),

            'photos_count' => (int) $this->photos_count,
            'comments_count' => (int) $this->comments_count,

            'user' => $this->relationLoaded('user') ? new User($this->user) : null,
        ];
    }
}
