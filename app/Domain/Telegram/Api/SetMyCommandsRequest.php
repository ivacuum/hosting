<?php

namespace App\Domain\Telegram\Api;

readonly class SetMyCommandsRequest extends TelegramRequest
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
