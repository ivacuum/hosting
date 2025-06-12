<?php

namespace App\Console\Commands;

use Ivacuum\Generic\Commands\Command;
use Ivacuum\Generic\Telegram\LanguageCode;
use Ivacuum\Generic\Telegram\TelegramClient;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand('telegram:delete-my-commands')]
class TelegramDeleteMyCommands extends Command
{
    /** @var array<LanguageCode> */
    private const array LANGUAGE_CODES = [
        LanguageCode::English,
        LanguageCode::Russian,
    ];

    protected $signature = 'telegram:delete-my-commands';
    protected $description = 'Delete menu commands';

    public function handle(TelegramClient $telegram)
    {
        foreach (self::LANGUAGE_CODES as $languageCode) {
            $response = $telegram
                ->languageCode($languageCode)
                ->deleteMyCommands();

            dump($response);
        }
    }
}
