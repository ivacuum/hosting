<?php

namespace App\Domain\Telegram;

class TelegramUpdateFactory
{
    private int $chatId = 1;
    private int $updateId = 1;
    private int $messageId = 1;
    private string $text = '';
    private string $lastName = 'Last';
    private string $username = 'example';
    private string $firstName = 'First';
    private string $languageCode = 'en';

    #[\NoDiscard]
    public function deeplink(string $deeplink): self
    {
        return $this->withText("/start {$deeplink}");
    }

    public function make(): array
    {
        return [
            'update_id' => $this->updateId,
            'message' => [
                'message_id' => $this->messageId,
                'from' => [
                    'id' => $this->chatId,
                    'is_bot' => false,
                    'first_name' => $this->firstName,
                    'last_name' => $this->lastName,
                    'username' => $this->username,
                    'language_code' => $this->languageCode,
                ],
                'chat' => [
                    'id' => $this->chatId,
                    'first_name' => $this->firstName,
                    'last_name' => $this->lastName,
                    'username' => $this->username,
                    'type' => 'private',
                ],
                'date' => now()->timestamp,
                'text' => $this->text,
            ],
        ];
    }

    public static function new()
    {
        return new self;
    }

    #[\NoDiscard]
    public function photo(): self
    {
        return $this->withText('/photo');
    }

    #[\NoDiscard]
    public function start(): self
    {
        return $this->withText('/start');
    }

    #[\NoDiscard]
    public function withText(string $text): self
    {
        return clone ($this, ['text' => $text]);
    }
}
