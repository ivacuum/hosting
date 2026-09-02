<?php

namespace App\Domain\Telegram\Api;

use Illuminate\Container\Attributes\Config;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\App;

class TelegramClient
{
    private int $chatId;
    private bool $asResponse = false;
    private int|null $replyToMessageId = null;
    private bool|null $disableWebPagePreview;
    private ParseMode|null $parseMode = null;
    private LanguageCode|null $languageCode = null;
    private InlineKeyboardMarkup|null $replyMarkup = null;

    public function __construct(
        private readonly Factory $http,
        #[Config('services.telegram.api_url')]
        private readonly string $apiUrl,
        #[Config('services.telegram.bot_token')]
        private readonly string $botToken,
        #[Config('services.telegram.disable_web_page_preview')]
        bool|null $disableWebPagePreview,
    ) {
        $this->disableWebPagePreview = $disableWebPagePreview;
    }

    public function asResponse(): self
    {
        return clone ($this, ['asResponse' => true]);
    }

    public function chat(int $chatId): self
    {
        return clone ($this, ['chatId' => $chatId]);
    }

    public function deleteMyCommands(): TelegramResponse|array
    {
        $request = new DeleteMyCommandsRequest($this->languageCode);

        return $this->send($request);
    }

    public function disableWebPagePreview(bool $disableWebPagePreview = true): self
    {
        return clone ($this, ['disableWebPagePreview' => $disableWebPagePreview]);
    }

    public function editMessageReplyMarkup(int $messageId): TelegramResponse|array
    {
        $request = new EditMessageReplyMarkupRequest($this->chatId, $messageId, $this->replyMarkup);

        return $this->send($request);
    }

    public function editMessageText(int $messageId, string $text): TelegramResponse|array
    {
        $request = new EditMessageTextRequest(
            $this->chatId,
            $messageId,
            $text,
            $this->disableWebPagePreview
        );

        return $this->send($request);
    }

    public function html(): self
    {
        return $this->parseMode(ParseMode::Html);
    }

    public function languageCode(LanguageCode|null $languageCode): self
    {
        return clone ($this, ['languageCode' => $languageCode]);
    }

    public function markdown(): self
    {
        return $this->parseMode(ParseMode::Markdown);
    }

    public function parseMode(ParseMode $parseMode): self
    {
        return clone ($this, ['parseMode' => $parseMode]);
    }

    public function replyMarkup(InlineKeyboardMarkup|null $replyMarkup): self
    {
        return clone ($this, ['replyMarkup' => $replyMarkup]);
    }

    public function replyToMessageId(int $messageId): self
    {
        return clone ($this, ['replyToMessageId' => $messageId]);
    }

    public function sendLocation(string $lat, string $lon): TelegramResponse|array
    {
        $request = new SendLocationRequest(
            $this->chatId,
            $lat,
            $lon,
            $this->replyMarkup,
            $this->replyToMessageId
        );

        return $this->send($request);
    }

    public function sendMessage(string $text): TelegramResponse|array
    {
        $request = new SendMessageRequest(
            $this->chatId,
            $text,
            $this->disableWebPagePreview,
            $this->parseMode,
            $this->replyMarkup
        );

        return $this->send($request);
    }

    public function sendPhoto(string $fileId, string|null $caption = null): TelegramResponse|array
    {
        $request = new SendPhotoRequest(
            $this->chatId,
            $fileId,
            $caption,
            $this->parseMode,
            $this->replyMarkup
        );

        return $this->send($request);
    }

    public function setMyCommands(BotCommand ...$commands): TelegramResponse|array
    {
        $request = new SetMyCommandsRequest($commands, $this->languageCode);

        return $this->send($request);
    }

    public function setWebhook(string $url, string|null $secretToken = null): TelegramResponse|array
    {
        $request = new SetWebhookRequest($url, $secretToken);

        return $this->send($request);
    }

    private function http(): PendingRequest
    {
        return $this->http
            ->createPendingRequest()
            ->baseUrl("{$this->apiUrl}/bot{$this->botToken}/")
            ->connectTimeout(3)
            ->timeout(App::runningInConsole() ? 60 : 15)
            ->throw();
    }

    private function send(TelegramRequest $request): TelegramResponse|array
    {
        if ($this->asResponse) {
            return $request->responsePayload();
        }

        return new TelegramResponse($this->sendRequest($request));
    }

    private function sendRequest(TelegramRequest $request): Response
    {
        try {
            return $request->send($this->http());
        } catch (RequestException $e) {
            throw TelegramException::fromLaravelRequestException($e);
        } catch (\Throwable $e) {
            throw TelegramException::generalError($e);
        }
    }
}
