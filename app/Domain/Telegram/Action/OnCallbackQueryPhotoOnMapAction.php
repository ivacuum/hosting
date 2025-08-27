<?php

namespace App\Domain\Telegram\Action;

use App\Domain\Life\Models\Photo;
use App\Domain\Telegram\Api\InlineKeyboardButton;
use App\Domain\Telegram\Api\InlineKeyboardMarkup;
use App\Domain\Telegram\Api\TelegramClient;

class OnCallbackQueryPhotoOnMapAction
{
    public function __construct(private TelegramClient $telegram) {}

    public function execute(int $chatId, int $photoId, int $messageId): array|null
    {
        event(new \App\Events\Stats\TelegramPhotoOnMapCallbackQuery);

        $photo = Photo::query()->find($photoId);

        if ($photo === null) {
            return null;
        }

        $url = url(to('photos/map', ['photo' => $photo->slug]));

        return $this->telegram
            ->asResponse()
            ->chat($chatId)
            ->replyToMessageId($messageId)
            ->replyMarkup(
                InlineKeyboardMarkup::make()->addRow(
                    new InlineKeyboardButton('🗺 Карта на сайте', $url)
                )
            )
            ->sendLocation($photo->point->lat, $photo->point->lon);
    }
}
