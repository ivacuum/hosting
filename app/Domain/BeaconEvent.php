<?php namespace App\Domain;

class BeaconEvent
{
    public function __construct(public readonly string $event, public readonly ?int $id)
    {
    }

    public static function fromArray(array $payload)
    {
        return new self(
            $payload['event'],
            $payload['id'] ?? null
        );
    }
}
