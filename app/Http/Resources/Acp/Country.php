<?php namespace App\Http\Resources\Acp;

use Illuminate\Http\Resources\Json\Resource;

/**
 * @mixin \App\Country
 */
class Country extends Resource
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
            'flag_url' => $this->flagUrl(),
            'breadcrumb' => $this->breadcrumb(),

            'edit_url' => $this->when(
                $me->can('edit', 'App\Country'),
                path(['App\Http\Controllers\Acp\Countries', 'edit'], $this)
            ),
            'show_url' => $this->when(
                $me->can('show', 'App\Country'),
                path(['App\Http\Controllers\Acp\Countries', 'show'], $this)
            ),
            'trips_url' => $this->when(
                $me->can('list', 'App\Trip'),
                path(['App\Http\Controllers\Acp\Trips', 'index'], $foreignKey)
            ),
            'cities_url' => $this->when(
                $me->can('show', 'App\City'),
                path(['App\Http\Controllers\Acp\Cities', 'index'], $foreignKey)
            ),

            'trips_count' => (int) $this->trips_count,
            'cities_count' => (int) $this->cities_count,
        ];
    }
}
