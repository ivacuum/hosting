<?php

namespace App\Domain\Instagram;

use App\Http\HttpRequestV2;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

readonly class InstagramRefreshAccessTokenRequest implements HttpRequestV2
{
    public function send(PendingRequest $http): Response
    {
        return $http->get('refresh_access_token', [
            'grant_type' => 'ig_refresh_token',
        ]);
    }
}
