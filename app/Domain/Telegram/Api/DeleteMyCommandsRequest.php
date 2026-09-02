<?php

namespace App\Domain\Telegram\Api;

readonly class DeleteMyCommandsRequest extends TelegramRequest
{
    public function __construct(private LanguageCode|null $languageCode = null) {}

    public function endpoint(): string
    {
        return 'deleteMyCommands';
    }

    public function jsonSerialize(): array
    {
        return [
            'language_code' => $this->languageCode?->value,
        ];
    }
}
