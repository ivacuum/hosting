<?php

namespace App\Domain\Instagram;

use App\Http\HttpPost;

readonly class InstagramCreateMediaRequest implements HttpPost
{
    public function __construct(
        private string $imageUrl,
        private string $caption,
    ) {
        if (mb_strlen($caption) > 2200) {
            throw new \InvalidArgumentException('Caption must not exceed 2200 characters.');
        }
    }

    #[\Override]
    public function endpoint(): string
    {
        return 'me/media';
    }

    #[\Override]
    public function jsonSerialize(): array
    {
        return [
            'image_url' => $this->imageUrl,
            'caption' => $this->caption,
        ];
    }
}
