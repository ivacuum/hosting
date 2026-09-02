<?php

namespace Tests\Feature;

use App\Domain\Instagram\InstagramApi;
use App\Domain\Instagram\InstagramApiFake;
use App\Domain\Log\Models\ExternalHttpRequest;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class InstagramApiTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreateMedia(): void
    {
        \Http::fake(InstagramApiFake::createMedia('12345'));

        $response = $this->app
            ->make(InstagramApi::class)
            ->createMedia('token', 'https://example.com/IMG_0001.jpg', 'Caption #hashtag');

        $this->assertTrue($response->successful);
        $this->assertSame('12345', $response->containerId);
    }

    public function testMe(): void
    {
        \Http::fake(InstagramApiFake::me());

        $response = $this->app
            ->make(InstagramApi::class)
            ->me('token');

        $this->assertTrue($response->successful);
    }

    public function testNoCredentialsLogged(): void
    {
        \Http::fake(InstagramApiFake::refreshAccessToken('new-secret-token'));

        $this->app
            ->make(InstagramApi::class)
            ->refreshAccessToken('current-secret-token');

        $request = ExternalHttpRequest::query()
            ->latest('id')
            ->first();

        $json = $request->toJson();

        $this->assertStringNotContainsString('current-secret-token', $json);
        $this->assertStringNotContainsString('new-secret-token', $json);
    }

    public function testPublishMedia(): void
    {
        \Http::fake(InstagramApiFake::publishMedia('1973456852'));

        $response = $this->app
            ->make(InstagramApi::class)
            ->publishMedia('token', '1234567890');

        $this->assertTrue($response->successful);
        $this->assertSame('1973456852', $response->id);
    }

    public function testRefreshAccessToken(): void
    {
        \Http::fake(InstagramApiFake::refreshAccessToken('new_token'));

        $response = $this->app
            ->make(InstagramApi::class)
            ->refreshAccessToken('token');

        $this->assertTrue($response->successful);
        $this->assertSame('new_token', $response->accessToken);
    }
}
