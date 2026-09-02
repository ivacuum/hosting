<?php

namespace App\Domain\Instagram;

use App\Http\HttpRequestV2;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

readonly class InstagramMeRequest implements HttpRequestV2
{
    public function send(PendingRequest $http): Response
    {
        return $http->get('me', [
            'fields' => implode(',', [
                'user_id',
                'username',
                'name',
                'account_type',
                'profile_picture_url',
                'followers_count',
                'follows_count',
                'media_count',
            ]),
        ]);
    }
}
