<?php namespace App\Http\Resources\Acp;

use Illuminate\Http\Resources\Json\Resource;

/**
 * @mixin \App\Tag
 */
class Tag extends Resource
{
    public function toArray($request)
    {
        /* @var \App\User $me */
        $me = $request->user();
        $foreign_key = [$this->getForeignKey() => $this->id];

        return [
            'id' => $this->id,
            'title' => $this->title,
            'views' => $this->views,
            'breadcrumb' => $this->breadcrumb(),

            'edit_url' => $this->when($me->can('edit', 'App\Tag'), path('Acp\Tags@edit', $this)),
            'show_url' => $this->when($me->can('show', 'App\Tag'), path('Acp\Tags@show', $this)),
            'photos_url' => $this->when($me->can('show', 'App\Photo'), path('Acp\Photos@index', $foreign_key)),

            'photos_count' => $this->photos_count,
        ];
    }
}
