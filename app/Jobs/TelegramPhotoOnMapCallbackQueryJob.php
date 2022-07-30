<?php namespace App\Jobs;

use App\Photo;
use Ivacuum\Generic\Telegram\InlineKeyboardButton;
use Ivacuum\Generic\Telegram\InlineKeyboardMarkup;
use Ivacuum\Generic\Telegram\TelegramClient;

class TelegramPhotoOnMapCallbackQueryJob extends AbstractJob
{
    public function __construct(private int $chatId, private int $photoId, private int $messageId)
    {
    }

    public function handle(TelegramClient $telegram)
    {
        $photo = Photo::findOrFail($this->photoId);

        $www = url(to('photos/map', ['photo' => $photo->slug]));

        $telegram
            ->chat($this->chatId)
            ->replyToMessageId($this->messageId)
            ->replyMarkup(
                InlineKeyboardMarkup::make()->addRow(
                    new InlineKeyboardButton('🗺 Карта на сайте', $www)
                )
            )
            ->sendLocation($photo->point->lat, $photo->point->lon);

        event(new \App\Events\Stats\TelegramPhotoOnMapCallbackQuery);
    }
}
