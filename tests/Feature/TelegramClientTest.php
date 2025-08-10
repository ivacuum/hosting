<?php

namespace Tests\Feature;

use App\Domain\Log\Models\ExternalHttpRequest;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Client\Request;
use Ivacuum\Generic\Telegram\InlineKeyboardButton;
use Ivacuum\Generic\Telegram\InlineKeyboardMarkup;
use Ivacuum\Generic\Telegram\TelegramClient;
use Ivacuum\Generic\Telegram\TelegramException;
use Ivacuum\Generic\Telegram\TelegramResponse;
use Tests\TestCase;

class TelegramClientTest extends TestCase
{
    use DatabaseTransactions;

    public function testBadMarkdown()
    {
        \Http::fake([
            ...TelegramResponse::fakeBadMarkdown(),
        ]);

        config(['services.telegram.bot_token' => '1234:token']);

        $this->expectException(TelegramException::class);
        $this->expectExceptionMessage('400 - Bad Request: can\'t parse entities');

        app(TelegramClient::class)
            ->chat(12345)
            ->sendMessage('New message from mail@example.com');
    }

    public function testNoCredentialsLogged()
    {
        \Http::fake([
            ...TelegramResponse::fakeSuccess(),
        ]);

        app(TelegramClient::class)
            ->chat(12345)
            ->sendMessage('Text');

        $request = ExternalHttpRequest::query()->latest('id')->first();

        $this->assertSame('/botTelegramBotToken/sendMessage', $request->path);
    }

    public function testSendMessage()
    {
        \Http::fake([
            ...TelegramResponse::fakeSuccess(),
        ]);

        config(['services.telegram.bot_token' => '1234:token']);

        app(TelegramClient::class)
            ->chat(12345)
            ->sendMessage('Some info to notify about');

        \Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.telegram.org/bot1234:token/sendMessage'
                && $request['chat_id'] === 12345
                && $request['text'] === 'Some info to notify about';
        });
    }

    public function testSendMessageAsResponse()
    {
        config(['services.telegram.bot_token' => '1234:token']);

        $response = app(TelegramClient::class)
            ->asResponse()
            ->chat(12345)
            ->sendMessage('Some info to notify about');

        $this->assertSame([
            'text' => 'Some info to notify about',
            'chat_id' => 12345,
            'method' => 'sendMessage',
        ], $response);

        $this->assertArrayNotHasKey('reply_markup', $response);
        $this->assertArrayNotHasKey('disable_web_page_preview', $response);
    }

    public function testSendMessageWithDisabledWebPagePreview()
    {
        \Http::fake([
            ...TelegramResponse::fakeSuccess(),
        ]);

        config(['services.telegram.bot_token' => '1234:token']);

        app(TelegramClient::class)
            ->chat(1)
            ->disableWebPagePreview()
            ->sendMessage('Text');

        \Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.telegram.org/bot1234:token/sendMessage'
                && $request['chat_id'] === 1
                && $request['text'] === 'Text'
                && $request['disable_web_page_preview'] === true;
        });
    }

    public function testSendMessageWithInlineKeyboard()
    {
        \Http::fake([
            ...TelegramResponse::fakeSuccess(),
        ]);

        config(['services.telegram.bot_token' => '1234:token']);

        app(TelegramClient::class)
            ->chat(12345)
            ->replyMarkup(
                InlineKeyboardMarkup::make()
                    ->addRow(new InlineKeyboardButton('Yes', callbackData: 'secret:yes'))
                    ->addRow(new InlineKeyboardButton('Link', 'https://example.com'))
            )
            ->sendMessage('Message with keyboard');

        \Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.telegram.org/bot1234:token/sendMessage'
                && $request['chat_id'] === 12345
                && $request['text'] === 'Message with keyboard'
                && $request['reply_markup']['inline_keyboard'] === [
                    [
                        [
                            'text' => 'Yes',
                            'callback_data' => 'secret:yes',
                        ],
                    ],
                    [
                        [
                            'url' => 'https://example.com',
                            'text' => 'Link',
                        ],
                    ],
                ];
        });
    }

    public function testSetWebhook()
    {
        \Http::fake([
            ...TelegramResponse::fakeSuccess(),
        ]);

        config(['services.telegram.bot_token' => '1234:token']);

        app(TelegramClient::class)
            ->setWebhook('https://localhost/telegram/webhook', 'secret');

        \Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.telegram.org/bot1234:token/setWebhook'
                && $request['url'] === 'https://localhost/telegram/webhook'
                && $request['secret_token'] === 'secret';
        });
    }
}
