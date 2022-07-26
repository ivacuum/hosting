<?php namespace App\Http\Requests;

use App\Support\Telegram\CallbackQuery;
use App\Support\Telegram\Message;
use Illuminate\Foundation\Http\FormRequest;

class TelegramWebhook extends FormRequest
{
    public readonly ?int $chatId;
    public readonly ?int $messageId;
    public readonly bool $shouldIgnoreWebhook;
    public readonly Message|null $message;
    public readonly CallbackQuery|null $callbackQuery;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
    }

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
        $this->shouldIgnoreWebhook = $this->header('X-Telegram-Bot-Api-Secret-Token') !== config('cfg.telegram.webhook_secret_token');
    }
}