<?php

namespace App\Domain\Telegram\Api;

readonly class BotCommand implements \JsonSerializable
{
    public function __construct(
        private string $command,
        private string $description,
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'command' => $this->command,
            'description' => $this->description,
        ];
    }
}
