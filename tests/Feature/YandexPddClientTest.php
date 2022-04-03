<?php namespace Tests\Feature;

use App\Services\YandexPdd\DkimStatusResponse;
use App\Services\YandexPdd\DomainsResponse;
use App\Services\YandexPdd\EmailEditResponse;
use App\Services\YandexPdd\EmailsResponse;
use App\Services\YandexPdd\YandexPddClient;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Client\Request;
use Tests\TestCase;

class YandexPddClientTest extends TestCase
{
    use DatabaseTransactions;

    public function testDkimStatus()
    {
        \Http::fake([
            ...DkimStatusResponse::fakeSuccess('example.com'),
            '*' => \Http::response(),
        ]);

        $yandex = $this->app->make(YandexPddClient::class);
        $response = $yandex->dkimStatus('token', 'example.com', true);

        $this->assertTrue($response->successful);

        \Http::assertSent(function (Request $request) {
            $this->assertStringStartsWith('https://pddimp.yandex.ru/api2/admin/dkim/status?', $request->url());
            $this->assertTrue($request->hasHeader('PddToken', 'token'));
            $this->assertSame('example.com', $request['domain']);
            $this->assertSame('yes', $request['secretkey']);

            return true;
        });
    }

    public function testDomains()
    {
        \Http::fake([
            ...DomainsResponse::fakeSuccess('example.com', ['alias.example.com']),
            '*' => \Http::response(),
        ]);

        $yandex = $this->app->make(YandexPddClient::class);
        $response = $yandex->domains('token');

        $this->assertTrue($response->successful);
    }

    public function testEmails()
    {
        \Http::fake([
            ...EmailsResponse::fakeSuccess('example.com', 'me@example.com'),
            '*' => \Http::response(),
        ]);

        $yandex = $this->app->make(YandexPddClient::class);
        $response = $yandex->emails('token', 'example.com');

        $this->assertTrue($response->successful);
    }

    public function testSetNewEmailPassword()
    {
        \Http::fake([
            ...EmailEditResponse::fakeSuccess('example.com', 'me@example.com'),
            '*' => \Http::response(),
        ]);

        $yandex = $this->app->make(YandexPddClient::class);
        $response = $yandex->setEmailPassword('token', 'example.com', 'me@example.com', 'password');

        $this->assertTrue($response->successful);
    }
}
