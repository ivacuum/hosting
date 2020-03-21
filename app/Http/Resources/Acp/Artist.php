<?php namespace App\Http\Resources\Acp;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Artist */
class Artist extends JsonResource
{
    public function toArray($request)
    {
        /** @var \App\User $me */
        $me = $request->user();

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'breadcrumb' => $this->breadcrumb(),

            'edit_url' => $this->when($me->can('edit', 'App\Artist'), path(['App\Http\Controllers\Acp\Artists', 'edit'], $this)),
            'show_url' => $this->when($me->can('show', 'App\Artist'), path(['App\Http\Controllers\Acp\Artists', 'show'], $this)),
        ];
    }
}
