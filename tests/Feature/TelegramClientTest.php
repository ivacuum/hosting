<?php

namespace Tests\Feature;

use App\Domain\Log\Models\ExternalHttpRequest;
use App\Domain\Telegram\Api\InlineKeyboardButton;
use App\Domain\Telegram\Api\InlineKeyboardMarkup;
use App\Domain\Telegram\Api\TelegramClient;
use App\Domain\Telegram\Api\TelegramException;
use App\Domain\Telegram\Api\TelegramResponse;
use App\Factory\ChatMessageFactory;
use App\Factory\UserFactory;
use App\Notifications\ChatMessagePublishedAdminNotification;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Client\Request;
use PHPUnit\Framework\Attributes\TestWith;
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
        $this->expectExceptionMessageIsOrContains("400 - Bad Request: can't parse entities");

        app(TelegramClient::class)
            ->chat(12345)
            ->sendMessage('New message from mail@example.com');
    }

    #[TestWith(['', 'user \#42'])]
    #[TestWith(['Автор_#1!', 'Автор\_\#1\!'])]
    public function testChatMessageNotificationEscapesMarkdown(string $login, string $expectedAuthor): void
    {
        \Http::fake([
            ...TelegramResponse::fakeSuccess(),
        ]);

        config([
            'services.telegram.admin_id' => 12345,
            'services.telegram.bot_token' => '1234:token',
        ]);

        $text = <<<'TEXT'
            # Заголовок _курсив_ *жирный* [ссылка](https://example.com/a-b?q=1#section)
            ~текст~ `код` > цитата + - = | {текст} . !
            Путь C:\temp\file, уже \# и \.
            <тег> & "кавычки" 'апостроф'
            TEXT;

        $expectedText = <<<'TEXT'
            \# Заголовок \_курсив\_ \*жирный\* \[ссылка\]\(https://example\.com/a\-b?q\=1\#section\)
            \~текст\~ \`код\` \> цитата \+ \- \= \| \{текст\} \. \!
            Путь C:\\temp\\file, уже \\\# и \\\.
            <тег\> & "кавычки" 'апостроф'
            TEXT;

        $user = UserFactory::new()->withId(42)->withLogin($login)->make();
        $chatMessage = ChatMessageFactory::new()->withText($text)->make();
        $chatMessage->setRelation('user', $user);

        $chatMessage->notifyNow(new ChatMessagePublishedAdminNotification($chatMessage));

        \Http::assertSentCount(1);
        \Http::assertSent(static function (Request $request) use ($expectedAuthor, $expectedText): bool {
            return $request->method() === 'POST'
                && $request->url() === 'https://api.telegram.org/bot1234:token/sendMessage'
                && $request['chat_id'] === 12345
                && $request['parse_mode'] === 'MarkdownV2'
                && $request['text'] === "💬 Сообщение в чат от {$expectedAuthor}\n{$expectedText}";
        });
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

        \Http::assertSent(static function (Request $request) {
            return $request->method() === 'POST'
                && $request->url() === 'https://api.telegram.org/bot1234:token/sendMessage'
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

        \Http::assertSent(static function (Request $request) {
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

        \Http::assertSent(static function (Request $request) {
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

        \Http::assertSent(static function (Request $request) {
            return $request->url() === 'https://api.telegram.org/bot1234:token/setWebhook'
                && $request['url'] === 'https://localhost/telegram/webhook'
                && $request['secret_token'] === 'secret';
        });
    }
}
