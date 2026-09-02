<?php

namespace App\Domain\Telegram\Api;

use App\Http\HttpRequest;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

abstract readonly class TelegramRequest implements \JsonSerializable, HttpRequest
{
    abstract public function endpoint(): string;

    public function responsePayload(): array
    {
        return [
            ...$this->payload(),
            'method' => $this->endpoint(),
        ];
    }

    public function send(PendingRequest $http): Response
    {
        return $http->post($this->endpoint(), $this->payload());
    }

    private function filterNulls(array $payload): array
    {
        foreach ($payload as &$value) {
            if ($value instanceof \JsonSerializable) {
                $value = $value->jsonSerialize();
            }

            if (is_array($value)) {
                $value = $this->filterNulls($value);
            }
        }

        return array_filter($payload, static fn ($value) => $value !== null);
    }

    private function payload(): array
    {
        return $this->filterNulls($this->jsonSerialize());
    }
}
