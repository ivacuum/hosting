<?php namespace Tests\Feature;

use App\Services\YandexPdd\DkimStatusResponse;
use App\Services\YandexPdd\DnsRecordsResponse;
use App\Services\YandexPdd\DomainsResponse;
use App\Services\YandexPdd\EmailAddResponse;
use App\Services\YandexPdd\EmailEditResponse;
use App\Services\YandexPdd\EmailsResponse;
use App\Services\YandexPdd\RequestException;
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

        $response = $this->app->make(YandexPddClient::class)
            ->dkimStatus('token', 'example.com', true);

        $this->assertTrue($response->successful);

        \Http::assertSent(function (Request $request) {
            $this->assertStringStartsWith('https://pddimp.yandex.ru/api2/admin/dkim/status?', $request->url());
            $this->assertTrue($request->hasHeader('PddToken', 'token'));
            $this->assertSame('example.com', $request['domain']);
            $this->assertSame('yes', $request['secretkey']);

            return true;
        });
    }

    public function testDnsRecords()
    {
        \Http::fake([
            ...DnsRecordsResponse::fakeSuccess('example.com'),
            '*' => \Http::response(),
        ]);

        $response = $this->app->make(YandexPddClient::class)
            ->dnsRecords('token', 'example.com');

        $this->assertSame('example.com', $response->domain);
        $this->assertTrue($response->successful);
    }

    public function testDomains()
    {
        \Http::fake([
            ...DomainsResponse::fakeSuccess('example.com', ['alias.example.com']),
            '*' => \Http::response(),
        ]);

        $response = $this->app->make(YandexPddClient::class)
            ->domains('token');

        $this->assertTrue($response->successful);
    }

    public function testEmailAdd()
    {
        \Http::fake([
            ...EmailAddResponse::fakeSuccess('example.com', 'me@example.com'),
            '*' => \Http::response(),
        ]);

        $response = $this->app->make(YandexPddClient::class)
            ->emailAdd('token', 'example.com', 'me', 'pass');

        $this->assertTrue($response->successful);
        $this->assertSame('example.com', $response->domain);
        $this->assertSame('me@example.com', $response->login);
    }

    public function testEmailAddError()
    {
        \Http::fake([
            ...EmailAddResponse::fakeError(),
            '*' => \Http::response(),
        ]);

        $this->expectException(RequestException::class);

        $this->app->make(YandexPddClient::class)
            ->emailAdd('token', 'example.com', 'me', 'pass');
    }

    public function testEmails()
    {
        \Http::fake([
            ...EmailsResponse::fakeSuccess('example.com', 'me@example.com'),
            '*' => \Http::response(),
        ]);

        $response = $this->app->make(YandexPddClient::class)
            ->emails('token', 'example.com');

        $this->assertTrue($response->successful);
    }

    public function testSetNewEmailPassword()
    {
        \Http::fake([
            ...EmailEditResponse::fakeSuccess('example.com', 'me@example.com'),
            '*' => \Http::response(),
        ]);

        $response = $this->app->make(YandexPddClient::class)
            ->setEmailPassword('token', 'example.com', 'me@example.com', 'password');

        $this->assertTrue($response->successful);
    }
}
