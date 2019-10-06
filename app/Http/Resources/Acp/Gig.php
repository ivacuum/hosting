<?php namespace App\Http\Resources\Acp;

use Illuminate\Http\Resources\Json\Resource;

/**
 * @mixin \App\Gig
 */
class Gig extends Resource
{
    public function toArray($request)
    {
        /** @var \App\User $me */
        $me = $request->user();

        return [
            'id' => $this->id,
            'www' => $this->www(),
            'slug' => $this->slug,
            'title' => $this->title,
            'views' => $this->views,
            'status' => $this->status,
            'full_date' => $this->fullDate(),
            'breadcrumb' => $this->breadcrumb(),
            'meta_image' => $this->meta_image,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->metaDescription(),

            'edit_url' => $this->when($me->can('edit', 'App\Gig'), path(['App\Http\Controllers\Acp\Gigs', 'edit'], $this)),
            'show_url' => $this->when($me->can('show', 'App\Gig'), path(['App\Http\Controllers\Acp\Gigs', 'show'], $this)),
        ];
    }
}
