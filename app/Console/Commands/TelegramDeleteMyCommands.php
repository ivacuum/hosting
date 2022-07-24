<?php namespace App\Console\Commands;

use Ivacuum\Generic\Commands\Command;
use Ivacuum\Generic\Telegram\LanguageCode;
use Ivacuum\Generic\Telegram\TelegramClient;

class TelegramDeleteMyCommands extends Command
{
    /** @var array<LanguageCode> */
    private const LANGUAGE_CODES = [
        LanguageCode::English,
        LanguageCode::Russian,
    ];

    protected $signature = 'telegram:delete-my-commands';
    protected $description = 'Set menu commands';

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
