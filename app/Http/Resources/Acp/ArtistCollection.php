<?php namespace App\Http\Resources\Acp;

use App\Artist;

class ArtistCollection extends ResourceCollection
{
    public function with($request)
    {
        return [
            'meta' => [
                'new_url' => \Auth::user()->can('create', Artist::class)
                    ? path(['App\Http\Controllers\Acp\Artists', 'create'])
                    : null,
            ],
        ];
    }
}
