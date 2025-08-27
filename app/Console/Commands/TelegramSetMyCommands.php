<?php

namespace App\Console\Commands;

use App\Domain\Telegram\Api\BotCommand;
use App\Domain\Telegram\Api\LanguageCode;
use App\Domain\Telegram\Api\TelegramClient;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand('telegram:set-my-commands')]
class TelegramSetMyCommands extends Command
{
    /** @var array<LanguageCode> */
    private const array LANGUAGE_CODES = [
        LanguageCode::English,
        LanguageCode::Russian,
    ];

    protected $signature = 'telegram:set-my-commands';
    protected $description = 'Set menu commands';

    public function handle(TelegramClient $telegram)
    {
        foreach (self::LANGUAGE_CODES as $languageCode) {
            $response = $telegram
                ->languageCode($languageCode)
                ->setMyCommands(...$this->commands($languageCode));

            dump($response);
        }
    }

    private function commands(LanguageCode $languageCode)
    {
        return match ($languageCode) {
            LanguageCode::Russian => [
                new BotCommand('/photo', 'получить случайную фотографию'),
            ],
            default => [
                new BotCommand('/photo', 'get a random photo'),
            ],
        };
    }
}
