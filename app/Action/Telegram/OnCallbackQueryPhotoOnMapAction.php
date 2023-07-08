<?php

namespace App\Action\Telegram;

use App\Photo;
use Ivacuum\Generic\Telegram\InlineKeyboardButton;
use Ivacuum\Generic\Telegram\InlineKeyboardMarkup;
use Ivacuum\Generic\Telegram\TelegramClient;

class OnCallbackQueryPhotoOnMapAction
{
    public function __construct(private TelegramClient $telegram)
    {
    }

    public function execute(int $chatId, int $photoId, int $messageId): array|null
    {
        event(new \App\Events\Stats\TelegramPhotoOnMapCallbackQuery);

        $photo = Photo::find($photoId);

        if ($photo === null) {
            return null;
        }

        $www = url(to('photos/map', ['photo' => $photo->slug]));

        return $this->telegram
            ->asResponse()
            ->chat($chatId)
            ->replyToMessageId($messageId)
            ->replyMarkup(
                InlineKeyboardMarkup::make()->addRow(
                    new InlineKeyboardButton('🗺 Карта на сайте', $www)
                )
            )
            ->sendLocation($photo->point->lat, $photo->point->lon);
    }
}
