<?php

namespace Tests\Feature;

use App\Domain\Life\Factory\PhotoFactory;
use App\Domain\Telegram\TelegramUpdateCallbackQueryFactory;
use App\Domain\Telegram\TelegramUpdateFactory;
use App\Factory\LinkRequestFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TelegramBotTest extends TestCase
{
    use DatabaseTransactions;

    public function testCallbackQueryPhotoOnMap()
    {
        $photo = PhotoFactory::new()
            ->withPoint(10, 20)
            ->withTrip()
            ->create();

        $response = $this->postJson(
            'telegram/webhook',
            TelegramUpdateCallbackQueryFactory::new()
                ->withData("photoOnMap:{$photo->id}")
                ->make()
        );

        $this->assertSame(1, $response->json('chat_id'));
        $this->assertSame('10', $response->json('latitude'));
        $this->assertSame('20', $response->json('longitude'));
        $this->assertSame(1, $response->json('reply_to_message_id'));
        $this->assertSame('sendLocation', $response->json('method'));
    }

    public function testPhotoCommand()
    {
        PhotoFactory::new()
            ->withPoint(10, 20)
            ->withTrip()
            ->create();

        $response = $this->postJson(
            'telegram/webhook',
            TelegramUpdateFactory::new()
                ->photo()
                ->make()
        );

        $this->assertArrayHasKey('photo', $response->json());
        $this->assertSame(1, $response->json('chat_id'));
        $this->assertSame('sendPhoto', $response->json('method'));
    }

    public function testStartCommand()
    {
        $response = $this->postJson(
            'telegram/webhook',
            TelegramUpdateFactory::new()
                ->start()
                ->make()
        );

        $this->assertSame('Рановато вы на огонек, потому что инструкций по боту еще нет. Предлагаю в качестве развлечения посмотреть случайную фотографию /photo.', $response->json('text'));
        $this->assertSame(1, $response->json('chat_id'));
        $this->assertSame('sendMessage', $response->json('method'));
    }

    public function testStartCommandWithParameter()
    {
        \Event::fake(\App\Events\Stats\TelegramAccountLinked::class);

        $linkRequest = LinkRequestFactory::new()
            ->withToken('test')
            ->withUser()
            ->create();

        $response = $this->postJson(
            'telegram/webhook',
            TelegramUpdateFactory::new()
                ->deeplink('test')
                ->make()
        );

        \Event::assertDispatched(\App\Events\Stats\TelegramAccountLinked::class);

        $this->assertSame('Запомнили ваш аккаунт. Теперь мы можете получать уведомления от сайта прямо в этот диалог.', $response->json('text'));
        $this->assertSame(1, $response->json('chat_id'));
        $this->assertSame('sendMessage', $response->json('method'));

        $this->assertSame(1, $linkRequest->user->telegram_id);
        $this->assertNotNull($linkRequest->user->telegram_linked_at);
        $this->assertModelMissing($linkRequest);
    }

    public function testStartCommandWithParameterLinkRequestNotFound()
    {
        $response = $this->postJson(
            'telegram/webhook',
            TelegramUpdateFactory::new()
                ->deeplink('test')
                ->make()
        );

        $this->assertSame('Не удалось найти ваш запрос на привязку аккаунта. Пожалуйста, повторите попытку на сайте.', $response->json('text'));
        $this->assertSame(1, $response->json('chat_id'));
        $this->assertSame('sendMessage', $response->json('method'));
    }
}
