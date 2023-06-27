<?php

namespace App\Domain;

readonly class BeaconEvent
{
    public function __construct(
        public string $event,
        public int|null $id,
        public string|null $slug
    ) {
    }

    public static function fromArray(array $payload)
    {
        return new self(
            $payload['event'],
            $payload['id'] ?? null,
            $payload['slug'] ?? null,
        );
    }
}
