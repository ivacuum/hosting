<?php

namespace App\Http\Requests;

use App\Domain\Config;
use App\Support\Telegram\CallbackQuery;
use App\Support\Telegram\Message;
use Illuminate\Foundation\Http\Attributes\FailOnUnknownFields;
use Illuminate\Foundation\Http\FormRequest;

#[FailOnUnknownFields(false)]
class TelegramWebhook extends FormRequest
{
    public readonly int|null $chatId;
    public readonly int|null $messageId;
    public readonly Message|null $message;
    public readonly CallbackQuery|null $callbackQuery;

    public function authorize(): bool
    {
        $expectedToken = Config::TelegramWebhookSecretToken->get();

        if ($expectedToken === null || $expectedToken === '') {
            return true;
        }

        $providedToken = $this->header('X-Telegram-Bot-Api-Secret-Token');

        return is_string($expectedToken)
            && is_string($providedToken)
            && hash_equals($expectedToken, $providedToken);
    }

    public function rules(): array
    {
        return [];
    }

    #[\Override]
    protected function passedValidation()
    {
        $this->chatId = $this->json('message.chat.id')
            ?? $this->json('callback_query.message.chat.id');
        $this->message = $this->has('message')
            ? Message::fromArray($this->json('message'))
            : null;
        $this->messageId = $this->json('message.message_id')
            ?? $this->json('callback_query.message.message_id');
        $this->callbackQuery = $this->has('callback_query')
            ? CallbackQuery::fromArray($this->json('callback_query'))
            : null;
    }
}
