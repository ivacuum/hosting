<?php namespace Tests\Feature;

use App\Factory\YandexPddDnsRecordFactory;
use App\Services\YandexPdd\DkimStatusResponse;
use App\Services\YandexPdd\DnsRecordAddResponse;
use App\Services\YandexPdd\DnsRecordDeleteResponse;
use App\Services\YandexPdd\DnsRecordEditResponse;
use App\Services\YandexPdd\DnsRecordsResponse;
use App\Services\YandexPdd\DnsRecordType;
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
        \Http::preventStrayRequests()->fake([
            ...DkimStatusResponse::fakeSuccess('example.com'),
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

    public function testDnsRecordAdd()
    {
        \Http::preventStrayRequests()->fake([
            ...DnsRecordAddResponse::fakeSuccess('example.com', YandexPddDnsRecordFactory::a(5, 'example.com', '127.0.0.2', 'phpunit')),
        ]);

        $response = $this->app->make(YandexPddClient::class)
            ->addDnsRecord('token', 'example.com', DnsRecordType::A, 'phpunit', '127.0.0.2');

        $this->assertTrue($response->successful);
        $this->assertSame('example.com', $response->domain);
        $this->assertSame(DnsRecordType::A, $response->record->type);
        $this->assertSame(5, $response->record->id);
        $this->assertSame('127.0.0.2', $response->record->content);
        $this->assertSame('phpunit', $response->record->subdomain);
    }

    public function testDnsRecordDelete()
    {
        \Http::preventStrayRequests()->fake([
            ...DnsRecordDeleteResponse::fakeSuccess('example.com'),
        ]);

        $response = $this->app->make(YandexPddClient::class)
            ->deleteDnsRecord('token', 'example.com', 1);

        $this->assertSame('example.com', $response->domain);
        $this->assertTrue($response->successful);
    }

    public function testDnsRecordEdit()
    {
        \Http::preventStrayRequests()->fake([
            ...DnsRecordEditResponse::fakeSuccess('example.com', YandexPddDnsRecordFactory::a(5, 'example.com', '127.0.0.2', 'phpunit')),
        ]);

        $response = $this->app->make(YandexPddClient::class)
            ->editDnsRecord('token', 'example.com', 1, DnsRecordType::A, 'phpunit', '127.0.0.2');

        $this->assertTrue($response->successful);
        $this->assertSame('example.com', $response->domain);
        $this->assertSame(DnsRecordType::A, $response->record->type);
        $this->assertSame(5, $response->record->id);
        $this->assertSame('127.0.0.2', $response->record->content);
        $this->assertSame('phpunit', $response->record->subdomain);
    }

    public function testDnsRecords()
    {
        \Http::preventStrayRequests()->fake([
            ...DnsRecordsResponse::fakeSuccess('example.com'),
        ]);

        $response = $this->app->make(YandexPddClient::class)
            ->dnsRecords('token', 'example.com');

        $this->assertSame('example.com', $response->domain);
        $this->assertTrue($response->successful);
    }

    public function testDomains()
    {
        \Http::preventStrayRequests()->fake([
            ...DomainsResponse::fakeSuccess('example.com', ['alias.example.com']),
        ]);

        $response = $this->app->make(YandexPddClient::class)
            ->domains('token');

        $this->assertTrue($response->successful);
    }

    public function testEmailAdd()
    {
        \Http::preventStrayRequests()->fake([
            ...EmailAddResponse::fakeSuccess('example.com', 'me@example.com'),
        ]);

        $response = $this->app->make(YandexPddClient::class)
            ->emailAdd('token', 'example.com', 'me', 'pass');

        $this->assertTrue($response->successful);
        $this->assertSame('example.com', $response->domain);
        $this->assertSame('me@example.com', $response->login);
    }

    public function testEmailAddError()
    {
        \Http::preventStrayRequests()->fake([
            ...EmailAddResponse::fakeError(),
        ]);

        $this->expectException(RequestException::class);

        $this->app->make(YandexPddClient::class)
            ->emailAdd('token', 'example.com', 'me', 'pass');
    }

    public function testEmails()
    {
        \Http::preventStrayRequests()->fake([
            ...EmailsResponse::fakeSuccess('example.com', 'me@example.com'),
        ]);

        $response = $this->app->make(YandexPddClient::class)
            ->emails('token', 'example.com');

        $this->assertTrue($response->successful);
    }

    public function testSetNewEmailPassword()
    {
        \Http::preventStrayRequests()->fake([
            ...EmailEditResponse::fakeSuccess('example.com', 'me@example.com'),
        ]);

        $response = $this->app->make(YandexPddClient::class)
            ->setEmailPassword('token', 'example.com', 'me@example.com', 'password');

        $this->assertTrue($response->successful);
    }
}
