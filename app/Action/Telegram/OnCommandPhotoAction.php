<?php

namespace App\Action\Telegram;

use App\Photo;
use App\Scope\PhotoOnMapScope;
use App\Scope\PhotoPublishedScope;
use Ivacuum\Generic\Telegram\InlineKeyboardButton;
use Ivacuum\Generic\Telegram\InlineKeyboardMarkup;
use Ivacuum\Generic\Telegram\TelegramClient;

class OnCommandPhotoAction
{
    public function __construct(private TelegramClient $telegram)
    {
    }

    public function execute(int $chatId): array
    {
        event(new \App\Events\Stats\TelegramPhotoCommand);

        /** @var Photo $photo */
        $photo = Photo::query()
            ->tap(new PhotoPublishedScope)
            ->tap(new PhotoOnMapScope)
            ->inRandomOrder()
            ->first();

        $url = url($photo->rel->www('#' . basename($photo->slug)));

        return $this->telegram
            ->asResponse()
            ->chat($chatId)
            ->replyMarkup(
                InlineKeyboardMarkup::make()
                    ->addRow(
                        new InlineKeyboardButton('📝 Контекст', $url),
                        new InlineKeyboardButton('📍 Карта', callbackData: "photoOnMap:{$photo->id}")
                    )
            )
            ->sendPhoto($photo->mobileUrl());
    }
}
