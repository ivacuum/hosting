<?php namespace Tests\Feature;

use App\ExternalHttpRequest;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Client\Request;
use Ivacuum\Generic\Telegram\InlineKeyboardButton;
use Ivacuum\Generic\Telegram\InlineKeyboardMarkup;
use Ivacuum\Generic\Telegram\TelegramClient;
use Ivacuum\Generic\Telegram\TelegramResponse;
use Tests\TestCase;

class TelegramClientTest extends TestCase
{
    use DatabaseTransactions;

    public function testNoCredentialsLogged()
    {
        \Http::preventStrayRequests()->fake([
            ...TelegramResponse::fakeSuccess(),
        ]);

        app(TelegramClient::class)
            ->chat(12345)
            ->sendMessage('Text');

        $request = ExternalHttpRequest::latest('id')->first();

        $this->assertSame('/botTelegramBotToken/sendMessage', $request->path);
    }

    public function testSendMessage()
    {
        \Http::preventStrayRequests()->fake([
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

    public function testSendMessageWithDisabledWebPagePreview()
    {
        \Http::preventStrayRequests()->fake([
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
        \Http::preventStrayRequests()->fake([
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
        \Http::preventStrayRequests()->fake([
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
