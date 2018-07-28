<?php namespace App\Http\Resources\Acp;

use Illuminate\Http\Resources\Json\Resource;

/**
 * @mixin \App\Artist
 */
class Artist extends Resource
{
    public function toArray($request)
    {
        /* @var \App\User $me */
        $me = $request->user();

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'breadcrumb' => $this->breadcrumb(),

            'edit_url' => $this->when($me->can('edit', 'App\Artist'), path('Acp\Artists@edit', $this)),
            'show_url' => $this->when($me->can('show', 'App\Artist'), path('Acp\Artists@show', $this)),
        ];
    }
}
