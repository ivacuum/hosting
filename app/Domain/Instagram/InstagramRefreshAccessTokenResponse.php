<?php

namespace App\Domain\Instagram;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;

readonly class InstagramRefreshAccessTokenResponse
{
    public bool $successful;
    public int|null $expiresIn;
    public string|null $accessToken;

    public function __construct(public Response $response)
    {
        $this->successful = $response->json('error') === null;
        $this->accessToken = $response->json('access_token');
        $this->expiresIn = $response->json('expires_in');
    }

    public static function fakeError(): PromiseInterface
    {
        return Factory::response([
            'error' => [
                'message' => 'Invalid OAuth access token - Cannot parse access token',
                'type' => 'OAuthException',
                'code' => 190,
                'fbtrace_id' => 'xxx',
            ],
        ]);
    }

    public static function fakeSuccess(string $accessToken = 'xxx'): PromiseInterface
    {
        return Factory::response([
            'access_token' => $accessToken,
            'token_type' => 'bearer',
            'expires_in' => 5183944,
        ]);
    }
}
