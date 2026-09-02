<?php

namespace App\Domain\Instagram;

use App\Http\HttpRequest;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

readonly class InstagramCreateMediaRequest implements HttpRequest
{
    public function __construct(
        private string $imageUrl,
        private string $caption,
    ) {
        if (mb_strlen($caption) > 2200) {
            throw new \InvalidArgumentException('Caption must not exceed 2200 characters.');
        }
    }

    public function send(PendingRequest $http): Response
    {
        return $http->post('me/media', [
            'image_url' => $this->imageUrl,
            'caption' => $this->caption,
        ]);
    }
}
