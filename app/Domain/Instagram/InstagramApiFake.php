<?php

namespace App\Domain\Instagram;

class InstagramApiFake
{
    public static function createMedia(string $id = '1234567890'): array
    {
        return [
            'graph.vacuum.name/v23.0/me/media?*' => InstagramCreateMediaResponse::fakeSuccess($id),
        ];
    }

    public static function createMediaInvalid(): array
    {
        return [
            'graph.vacuum.name/v23.0/me/media?*' => InstagramCreateMediaResponse::fakeInvalidMedia(),
        ];
    }

    public static function me(): array
    {
        return [
            'graph.vacuum.name/v23.0/me?*' => InstagramMeResponse::fakeSuccess(),
        ];
    }

    public static function publishMedia(string $id = '1234567890'): array
    {
        return [
            'graph.vacuum.name/v23.0/me/media_publish?*' => InstagramPublishMediaResponse::fakeSuccess($id),
        ];
    }

    public static function publishMediaNotAvailableThenSuccess(string $id = '1234567890'): array
    {
        return [
            'graph.vacuum.name/v23.0/me/media_publish?*' => \Http::sequence()
                ->pushResponse(InstagramPublishMediaResponse::fakeMediaNotAvailable())
                ->pushResponse(InstagramPublishMediaResponse::fakeSuccess($id)),
        ];
    }

    public static function refreshAccessToken(string $accessToken = 'xxx'): array
    {
        return [
            'graph.vacuum.name/v23.0/refresh_access_token?*' => InstagramRefreshAccessTokenResponse::fakeSuccess($accessToken),
        ];
    }
}
