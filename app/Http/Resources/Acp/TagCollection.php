<?php namespace App\Http\Resources\Acp;

use App\Tag;

class TagCollection extends ResourceCollection
{
    public function with($request)
    {
        return [
            'meta' => [
                'new_url' => \Auth::user()->can('create', Tag::class) ? path('Acp\Tags@create') : null,
            ],
        ];
    }
}
