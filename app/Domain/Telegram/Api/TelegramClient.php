<?php

namespace App\Domain\Telegram\Api;

use App\Action\FilterNullsAction;
use App\Http\HttpRequest;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\RequestException;

class TelegramClient
{
    private int $chatId;
    private bool $asResponse = false;
    private int|null $replyToMessageId = null;
    private bool|null $disableWebPagePreview;
    private ParseMode|null $parseMode = null;
    private LanguageCode|null $languageCode = null;
    private InlineKeyboardMarkup|null $replyMarkup = null;

    public function __construct(private Factory $http, private FilterNullsAction $filterNulls)
    {
        $this->disableWebPagePreview = config('services.telegram.disable_web_page_preview');
    }

    public function asResponse()
    {
        $telegram = clone $this;
        $telegram->asResponse = true;

        return $telegram;
    }

    public function chat(int $chatId)
    {
        $telegram = clone $this;
        $telegram->chatId = $chatId;

        return $telegram;
    }

    public function deleteMyCommands()
    {
        $request = new DeleteMyCommandsRequest($this->languageCode);

        return $this->send($request);
    }

    public function disableWebPagePreview(bool $disableWebPagePreview = true)
    {
        $telegram = clone $this;
        $telegram->disableWebPagePreview = $disableWebPagePreview;

        return $telegram;
    }

    public function editMessageReplyMarkup(int $messageId)
    {
        $request = new EditMessageReplyMarkupRequest($this->chatId, $messageId, $this->replyMarkup);

        return $this->send($request);
    }

    public function editMessageText(int $messageId, string $text)
    {
        $request = new EditMessageTextRequest(
            $this->chatId,
            $messageId,
            $text,
            $this->disableWebPagePreview
        );

        return $this->send($request);
    }

    public function html()
    {
        return $this->parseMode(ParseMode::Html);
    }

    public function languageCode(LanguageCode|null $languageCode)
    {
        $telegram = clone $this;
        $telegram->languageCode = $languageCode;

        return $telegram;
    }

    public function markdown()
    {
        return $this->parseMode(ParseMode::Markdown);
    }

    public function parseMode(ParseMode $parseMode)
    {
        $telegram = clone $this;
        $telegram->parseMode = $parseMode;

        return $telegram;
    }

    public function replyMarkup(InlineKeyboardMarkup|null $replyMarkup)
    {
        $telegram = clone $this;
        $telegram->replyMarkup = $replyMarkup;

        return $telegram;
    }

    public function replyToMessageId(int $messageId)
    {
        $telegram = clone $this;
        $telegram->replyToMessageId = $messageId;

        return $telegram;
    }

    public function sendLocation(string $lat, string $lon)
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

    public function sendMessage(string $text)
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

    public function sendPhoto(string $fileId, string|null $caption = null)
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

    public function setMyCommands(BotCommand ...$commands)
    {
        $request = new SetMyCommandsRequest($commands, $this->languageCode);

        return $this->send($request);
    }

    public function setWebhook(string $url, string|null $secretToken = null)
    {
        $request = new SetWebhookRequest($url, $secretToken);

        return $this->send($request);
    }

    private function configureClient()
    {
        $botToken = config('services.telegram.bot_token');

        return $this->http
            ->baseUrl("https://api.telegram.org/bot{$botToken}/")
            ->timeout(\App::runningInConsole() ? 60 : 15)
            ->throw();
    }

    private function payload(HttpRequest $request)
    {
        $payload = $request->jsonSerialize();

        if (is_array($payload)) {
            if ($this->asResponse) {
                $payload['method'] = $request->endpoint();
            }

            return $this->filterNulls->execute($payload);
        }

        return $payload;
    }

    private function send(HttpRequest $request)
    {
        if ($this->asResponse) {
            return $this->payload($request);
        }

        try {
            $response = $this->configureClient()
                ->post($request->endpoint(), $this->payload($request));

            return new TelegramResponse($response);
        } catch (ClientException $e) {
            throw TelegramException::errorResponse($e);
        } catch (RequestException $e) {
            throw TelegramException::fromLaravelRequestException($e);
        } catch (\Throwable $e) {
            throw TelegramException::generalError($e);
        }
    }
}
