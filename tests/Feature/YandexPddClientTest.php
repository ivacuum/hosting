<?php namespace Tests\Feature;

use App\Services\YandexPdd\YandexPddClient;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Request;
use Tests\TestCase;

class YandexPddClientTest extends TestCase
{
    public function testDkimStatus()
    {
        $this->swap(Factory::class, \Http::fake([
            'pddimp.yandex.ru/*' => \Http::response([
                'dkim' => [
                    'enabled' => 'yes',
                    'txtrecord' => 'txt',
                    'nsready' => 'yes',
                    'mailready' => 'yes',
                    'secretkey' => '-----BEGIN RSA PRIVATE KEY-----',
                ],
                'domain' => 'example.com',
                'success' => 'ok',
            ]),
            '*' => \Http::response(),
        ]));

        $telegram = $this->app->make(YandexPddClient::class);
        $telegram->dkimStatus('token', 'example.com', true);

        \Http::assertSent(function (Request $request) {
            return str_starts_with($request->url(), 'https://pddimp.yandex.ru/api2/admin/dkim/status?')
                && $request->hasHeader('PddToken', 'token')
                && $request['domain'] === 'example.com'
                && $request['secretkey'] === 'yes';
        });
    }
}
