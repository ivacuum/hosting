<?php namespace App\Http\Resources\Acp;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\City */
class City extends JsonResource
{
    public function toArray($request)
    {
        /** @var \App\User $me */
        $me = $request->user();
        $foreignKey = [$this->getForeignKey() => $this->id];

        return [
            'id' => $this->id,
            'lat' => $this->lat,
            'lon' => $this->lon,
            'www' => $this->www(),
            'iata' => $this->iata,
            'slug' => $this->slug,
            'title' => $this->title,
            'views' => $this->views,
            'breadcrumb' => $this->breadcrumb(),

            'edit_url' => $this->when(
                $me->can('edit', 'App\City'),
                path(['App\Http\Controllers\Acp\Cities', 'edit'], $this)
            ),
            'show_url' => $this->when(
                $me->can('show', 'App\City'),
                path(['App\Http\Controllers\Acp\Cities', 'show'], $this)
            ),
            'trips_url' => $this->when(
                $me->can('list', 'App\Trip'),
                path(['App\Http\Controllers\Acp\Trips', 'index'], $foreignKey)
            ),

            'trips_count' => (int) $this->trips_count,

            'country' => $this->relationLoaded('country') ? new Country($this->country) : null,
        ];
    }
}
