<?php

namespace App\Domain\Instagram;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;

readonly class InstagramMeResponse
{
    public bool $successful;

    public function __construct(Response $response)
    {
        $this->successful = $response->json('error') === null;
    }

    public static function fakeSuccess()
    {
        return [
            'https://graph.vacuum.name/v23.0/me*' => Factory::response([
                'id' => '12345',
                'user_id' => '1234567890',
                'username' => 'example',
                'name' => 'Name Surname',
                'account_type' => 'MEDIA_CREATOR',
                'profile_picture_url' => 'https://example.com/file.jpg',
                'followers_count' => 3,
                'follows_count' => 2,
                'media_count' => 1,
            ]),
        ];
    }
}
