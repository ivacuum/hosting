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

    public function deeplink(string $deeplink)
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

    public function photo()
    {
        return $this->withText('/photo');
    }

    public function start()
    {
        return $this->withText('/start');
    }

    public function withText(string $text)
    {
        $factory = clone $this;
        $factory->text = $text;

        return $factory;
    }
}
