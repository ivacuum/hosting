<?php namespace App\Http\Resources\Acp;

class CommentCollection extends ResourceCollection
{
    public function with($request)
    {
        return [
            'meta' => [
                'new_url' => null,
            ],
        ];
    }
}
