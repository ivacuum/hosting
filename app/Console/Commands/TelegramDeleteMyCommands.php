<?php

namespace App\Console\Commands;

use App\Domain\Telegram\Api\LanguageCode;
use App\Domain\Telegram\Api\TelegramClient;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;

#[Signature('telegram:delete-my-commands')]
#[Description('Delete menu commands')]
class TelegramDeleteMyCommands extends Command
{
    /** @var array<LanguageCode> */
    private const array LANGUAGE_CODES = [
        LanguageCode::English,
        LanguageCode::Russian,
    ];

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
