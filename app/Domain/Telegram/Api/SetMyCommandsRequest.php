<?php

namespace App\Domain\Telegram\Api;

use App\Http\HttpRequest;

readonly class SetMyCommandsRequest implements HttpRequest
{
    /** @param array<BotCommand> $commands */
    public function __construct(
        private array $commands,
        private LanguageCode|null $languageCode = null,
    ) {}

    public function endpoint(): string
    {
        return 'setMyCommands';
    }

    public function jsonSerialize(): array
    {
        return [
            'commands' => $this->commands,
            'language_code' => $this->languageCode?->value,
        ];
    }
}
