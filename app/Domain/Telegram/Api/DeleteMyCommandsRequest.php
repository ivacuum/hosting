<?php

namespace App\Domain\Telegram\Api;

use App\Http\HttpRequest;

readonly class DeleteMyCommandsRequest implements HttpRequest
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
