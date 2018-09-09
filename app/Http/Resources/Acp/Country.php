<?php namespace App\Http\Resources\Acp;

use Illuminate\Http\Resources\Json\Resource;

/**
 * @mixin \App\Country
 */
class Country extends Resource
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
            'flag_url' => $this->flagUrl(),
            'breadcrumb' => $this->breadcrumb(),

            'edit_url' => $this->when($me->can('edit', 'App\Country'), path('Acp\Countries@edit', $this)),
            'show_url' => $this->when($me->can('show', 'App\Country'), path('Acp\Countries@show', $this)),
            'trips_url' => $this->when($me->can('list', 'App\Trip'), path('Acp\Trips@index', $foreign_key)),
            'cities_url' => $this->when($me->can('show', 'App\City'), path('Acp\Cities@index', $foreign_key)),

            'trips_count' => (int) $this->trips_count,
            'cities_count' => (int) $this->cities_count,
        ];
    }
}
