<?php namespace App\Http\Resources\Acp;

use Illuminate\Http\Resources\Json\Resource;

/**
 * @mixin \App\City
 */
class City extends Resource
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

            'edit_url' => $this->when($me->can('edit', 'App\City'), path('Acp\Cities@edit', $this)),
            'show_url' => $this->when($me->can('show', 'App\City'), path('Acp\Cities@show', $this)),
            'trips_url' => $this->when($me->can('list', 'App\Trip'), path('Acp\Trips@index', $foreignKey)),

            'trips_count' => (int) $this->trips_count,

            'country' => $this->relationLoaded('country') ? new Country($this->country) : null,
        ];
    }
}
