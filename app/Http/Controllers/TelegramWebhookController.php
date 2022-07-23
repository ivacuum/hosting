<?php namespace App\Http\Controllers;

use App\Http\Requests\TelegramWebhook;
use App\Photo;
use App\Scope\PhotoOnMapScope;
use App\Scope\PhotoPublishedScope;
use Illuminate\Log\Logger;
use Ivacuum\Generic\Telegram\InlineKeyboardButton;
use Ivacuum\Generic\Telegram\InlineKeyboardMarkup;
use Ivacuum\Generic\Telegram\TelegramClient;

class TelegramWebhookController
{
    public function __construct(private TelegramClient $telegram)
    {
    }

    public function __invoke(Logger $logger, TelegramWebhook $request)
    {
        $this->telegram = $this->telegram->chat($request->chatId);

        if ($request->message && str_starts_with($request->message->text, '/')) {
            match ($request->message->text) {
                '/photo' => $this->onCommandPhoto(),
                '/start' => $this->onCommandStart(),
                default => null,
            };
        }

        if ($request->callbackQuery) {
            $data = $request->callbackQuery->data;

            if (str_contains($data, ':')) {
                match (str($data)->before(':')->toString()) {
                    'photoOnMap' => $this->onCallbackQueryPhotoOnMap($request),
                    default => null,
                };
            }
        }

        if (app()->isLocal()) {
            $logger->info(json_encode($request->all(), \JSON_PRETTY_PRINT));
        }

        event(new \App\Events\Stats\TelegramWebhookReceived);
    }

    private function onCallbackQueryPhotoOnMap(TelegramWebhook $request)
    {
        $photo = Photo::find(str($request->callbackQuery->data)->after('photoOnMap:'));

        $www = url(to('photos/map', ['photo' => $photo->slug]));

        $this->telegram
            ->replyToMessageId($request->messageId)
            ->replyMarkup(
                InlineKeyboardMarkup::make()->addRow(
                    new InlineKeyboardButton('🗺 Карта на сайте', $www)
                )
            )
            ->sendLocation($photo->point->lat, $photo->point->lon);

        event(new \App\Events\Stats\TelegramPhotoOnMapCallbackQuery);
    }

    private function onCommandPhoto()
    {
        /** @var Photo $photo */
        $photo = Photo::query()
            ->tap(new PhotoPublishedScope)
            ->tap(new PhotoOnMapScope)
            ->inRandomOrder()
            ->first();

        $www = url($photo->rel->www('#' . basename($photo->slug)));

        $this->telegram
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

    private function onCommandStart()
    {
        $this->telegram->sendMessage('Рановато вы на огонек, потому что инструкций по боту еще нет. Предлагаю в качестве развлечения посмотреть случайную фотографию /photo.');

        event(new \App\Events\Stats\TelegramStartCommand);
    }
}
