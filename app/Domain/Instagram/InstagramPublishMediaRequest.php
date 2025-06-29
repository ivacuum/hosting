<?php

namespace App\Domain\Instagram;

use App\Http\HttpPost;

readonly class InstagramPublishMediaRequest implements HttpPost
{
    public function __construct(private string $creationId) {}

    #[\Override]
    public function endpoint(): string
    {
        return 'me/media_publish';
    }

    #[\Override]
    public function jsonSerialize(): array
    {
        return [
            'creation_id' => $this->creationId,
        ];
    }
}
