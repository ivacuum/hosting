<?php

namespace App\Domain\Telegram\Api;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;

readonly class TelegramResponse
{
    public bool $successful;
    public int|null $messageId;

    public function __construct(Response $response)
    {
        $this->messageId = $response->json('result.message_id');
        $this->successful = $response->json('ok');
    }

    public static function fakeBadMarkdown()
    {
        return [
            'api.telegram.org/*' => Factory::response([
                'ok' => false,
                'error_code' => 400,
                'description' => "Bad Request: can't parse entities: Character '.' is reserved and must be escaped with the preceding '\\'",
            ], 400),
        ];
    }

    public static function fakeBlockedByUser()
    {
        return [
            'api.telegram.org/*' => Factory::response([
                'ok' => false,
                'error_code' => 403,
                'description' => 'Forbidden: bot was blocked by the user',
            ], 403),
        ];
    }

    public static function fakeSuccess()
    {
        return [
            'api.telegram.org/*' => Factory::response([
                'ok' => true,
            ]),
        ];
    }
}
