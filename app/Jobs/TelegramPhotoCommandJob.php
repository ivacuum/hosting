<?php namespace App\Jobs;

use App\Photo;
use App\Scope\PhotoOnMapScope;
use App\Scope\PhotoPublishedScope;
use Ivacuum\Generic\Telegram\InlineKeyboardButton;
use Ivacuum\Generic\Telegram\InlineKeyboardMarkup;
use Ivacuum\Generic\Telegram\TelegramClient;

class TelegramPhotoCommandJob extends AbstractJob
{
    public function __construct(private int $chatId)
    {
    }

    public function handle(TelegramClient $telegram)
    {
        /** @var Photo $photo */
        $photo = Photo::query()
            ->tap(new PhotoPublishedScope)
            ->tap(new PhotoOnMapScope)
            ->inRandomOrder()
            ->first();

        $www = url($photo->rel->www('#' . basename($photo->slug)));

        $telegram
            ->chat($this->chatId)
            ->replyMarkup(
                InlineKeyboardMarkup::make()
                    ->addRow(
                        new InlineKeyboardButton('📝 Контекст', $www),
                        new InlineKeyboardButton('📍 Карта', callbackData: "photoOnMap:{$photo->id}")
                    )
            )
            ->sendPhoto($photo->mobileUrl());

        event(new \App\Events\Stats\TelegramPhotoCommand);
    }
}
