<?php

namespace App\Domain\Instagram;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;

readonly class InstagramCreateMediaResponse
{
    public bool $successful;
    public string|null $containerId;

    public function __construct(public Response $response)
    {
        $this->successful = $response->json('error') === null;
        $this->containerId = $response->json('id');
    }

    public static function fakeInvalidMedia(): PromiseInterface
    {
        return Factory::response([
            'error' => [
                'message' => 'Only photo or video can be accepted as media type.',
                'type' => 'OAuthException',
                'code' => 9004,
                'error_subcode' => 2207052,
                'is_transient' => false,
                'error_user_title' => 'Ошибка при скачивании медиафайла. URI медиафайла не соответствует нашим требованиям.',
                'error_user_msg' => 'Не удалось извлечь медиафайл по URI: https://example.com/. Чтобы узнать подробнее, посмотрите раздел с ограничениями в нашем документе для разработчиков: https://developers.facebook.com/docs/instagram-platform/instagram-graph-api/reference/ig-user/media#creating',
                'fbtrace_id' => 'xxx',
            ],
        ], 400);
    }

    public static function fakeSuccess(string $id = '1234567890'): PromiseInterface
    {
        return Factory::response([
            'id' => $id,
        ]);
    }
}
