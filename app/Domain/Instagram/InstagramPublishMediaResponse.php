<?php

namespace App\Domain\Instagram;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;

readonly class InstagramPublishMediaResponse
{
    public bool $successful;
    public string|null $id;

    public function __construct(public Response $response)
    {
        $this->successful = $response->json('error') === null;
        $this->id = $response->json('id');
    }

    public static function fakeMediaNotAvailable(): PromiseInterface
    {
        return Factory::response([
            'error' => [
                'message' => 'Media ID is not available',
                'type' => 'OAuthException',
                'code' => 9007,
                'error_subcode' => 2207027,
                'is_transient' => false,
                'error_user_title' => 'Не удалось опубликовать',
                'error_user_msg' => 'Медиаданные не готовы к публикации. Немного подождите.',
                'fbtrace_id' => 'xxx',
            ],
        ], 400);
    }

    public static function fakeMediaNotFound(): PromiseInterface
    {
        return Factory::response([
            'error' => [
                'message' => 'The requested resource does not exist',
                'type' => 'OAuthException',
                'code' => 24,
                'error_subcode' => 2207008,
                'is_transient' => false,
                'error_user_title' => 'Редактор медиафайлов не найден',
                'error_user_msg' => 'Редактор медиафайлов с идентификатором создания 1234567890 не существует или уже истек.',
                'fbtrace_id' => 'xxx',
            ],
        ]);
    }

    public static function fakeSuccess(string $id = '1234567890'): PromiseInterface
    {
        return Factory::response([
            'id' => $id,
        ]);
    }
}
