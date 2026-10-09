<?php

namespace App\Domain\Telegram\Action;

use App\Domain\Life\Models\Photo;
use App\Domain\Life\Scope\PhotoOnMapScope;
use App\Domain\Life\Scope\PhotoPublishedScope;
use App\Domain\Telegram\Api\InlineKeyboardButton;
use App\Domain\Telegram\Api\InlineKeyboardMarkup;
use App\Domain\Telegram\Api\TelegramClient;

class OnCommandPhotoAction
{
    public function __construct(private TelegramClient $telegram) {}

    public function execute(int $chatId): array
    {
        event(new \App\Events\Stats\TelegramPhotoCommand);

        $randomId = Photo::query()
            ->tap(new PhotoPublishedScope)
            ->tap(new PhotoOnMapScope)
            ->inRandomOrder()
            ->value('id');

        $photo = $randomId === null
            ? null
            : Photo::query()->find($randomId);

        if ($photo === null) {
            return $this->telegram
                ->asResponse()
                ->chat($chatId)
                ->sendMessage(__('Пока нет фотографий для показа. Попробуйте позже.'));
        }

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
            ->sendPhoto($photo->originalUrl());
    }
}
