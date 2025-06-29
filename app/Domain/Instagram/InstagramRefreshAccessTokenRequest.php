<?php

namespace App\Domain\Instagram;

use App\Http\HttpRequest;

readonly class InstagramRefreshAccessTokenRequest implements HttpRequest
{
    #[\Override]
    public function endpoint(): string
    {
        return 'refresh_access_token';
    }

    #[\Override]
    public function jsonSerialize(): array
    {
        return [
            'grant_type' => 'ig_refresh_token',
        ];
    }
}
