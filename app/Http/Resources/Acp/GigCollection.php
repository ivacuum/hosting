<?php namespace App\Http\Resources\Acp;

use App\Gig;

class GigCollection extends ResourceCollection
{
    public function with($request)
    {
        return [
            'meta' => [
                'new_url' => \Auth::user()->can('create', Gig::class)
                    ? path(['App\Http\Controllers\Acp\Gigs', 'create'])
                    : null,
            ],
        ];
    }
}
