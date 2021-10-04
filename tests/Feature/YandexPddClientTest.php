<?php namespace Tests\Feature;

use App\Services\YandexPdd\DkimStatusResponse;
use App\Services\YandexPdd\YandexPddClient;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Request;
use Tests\TestCase;

class YandexPddClientTest extends TestCase
{
    public function testDkimStatus()
    {
        $this->swap(Factory::class, \Http::fake([
            'pddimp.yandex.ru/*' => DkimStatusResponse::fakeSuccess('example.com'),
            '*' => \Http::response(),
        ]));

        $telegram = $this->app->make(YandexPddClient::class);
        $telegram->dkimStatus('token', 'example.com', true);

        \Http::assertSent(function (Request $request) {
            $this->assertStringStartsWith('https://pddimp.yandex.ru/api2/admin/dkim/status?', $request->url());
            $this->assertTrue($request->hasHeader('PddToken', 'token'));
            $this->assertSame('example.com', $request['domain']);
            $this->assertSame('yes', $request['secretkey']);

            return true;
        });
    }
}
