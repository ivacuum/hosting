<?php namespace App\Http\Resources\Acp;

use App\Issue;

class IssueCollection extends ResourceCollection
{
    public function with($request)
    {
        return [
            'meta' => [
                'new_url' => \Auth::user()->can('create', Issue::class) ? path('Acp\Issues@create') : null,
            ],
        ];
    }
}
