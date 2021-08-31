<?php namespace Tests\Feature;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Request;
use Ivacuum\Generic\Telegram\TelegramClient;
use Tests\TestCase;

class TelegramClientTest extends TestCase
{
    public function testSendMessage()
    {
        $this->swap(Factory::class, \Http::fake());

        config(['cfg.telegram.bot_token' => '1234:token']);

        $telegram = $this->app->make(TelegramClient::class);
        $telegram->sendMessage(12345, 'Some info to notify about');

        \Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.telegram.org/bot1234:token/sendMessage'
                && $request['chat_id'] === 12345
                && $request['text'] === 'Some info to notify about';
        });
    }
}
