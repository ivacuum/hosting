<?php

namespace App\Domain\Instagram;

use App\Http\HttpRequest;

readonly class InstagramMeRequest implements HttpRequest
{
    #[\Override]
    public function endpoint(): string
    {
        return 'me';
    }

    #[\Override]
    public function jsonSerialize(): array
    {
        return [
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
        ];
    }
}
