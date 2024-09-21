<?php

namespace App\Domain\Telegram;

class TelegramUpdateCallbackQueryFactory
{
    private int $chatId = 1;
    private int $updateId = 1;
    private int $messageId = 1;
    private string $data = '';
    private string $lastName = 'Last';
    private string $username = 'example';
    private string $firstName = 'First';
    private string $languageCode = 'en';

    public function make(): array
    {
        return [
            'update_id' => $this->updateId,
            'callback_query' => [
                'id' => 1,
                'from' => [
                    'id' => $this->chatId,
                    'is_bot' => false,
                    'first_name' => $this->firstName,
                    'last_name' => $this->lastName,
                    'username' => $this->username,
                    'language_code' => $this->languageCode,
                ],
                'message' => [
                    'message_id' => $this->messageId,
                    'from' => [
                        'id' => 2,
                        'is_bot' => true,
                        'first_name' => 'Development Bot',
                        'username' => 'example_bot',
                    ],
                    'chat' => [
                        'id' => $this->chatId,
                        'first_name' => $this->firstName,
                        'last_name' => $this->lastName,
                        'username' => $this->username,
                        'type' => 'private',
                    ],
                    'date' => now()->timestamp,
                ],
                'data' => $this->data,
            ],
        ];
    }

    public static function new()
    {
        return new self;
    }

    public function withData(string $data)
    {
        $factory = clone $this;
        $factory->data = $data;

        return $factory;
    }
}
