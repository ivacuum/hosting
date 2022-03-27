<?php namespace App\Services\YandexPdd;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;

class DomainsResponse
{
    public $json;
    public bool $successful;

    public function __construct(Response $response)
    {
        $this->json = $response->json();
        $this->successful = $response->json('success') === 'ok';
    }

    public static function fakeSuccess(string $domain, array $aliases = [])
    {
        return [
            'https://pddimp.yandex.ru/api2/admin/domain/domains*' => Factory::response([
                'page' => 1,
                'total' => 1,
                'found' => 1,
                'domains' => [
                    [
                        'aliases' => $aliases,
                        'name' => $domain,
                        'emails-max-count' => 2147483647,
                        'show-ready-soon' => 'no',
                        'stage' => 'added',
                        'nsdelegated' => 'yes',
                        'from_registrar' => 'no',
                        'ws_technical' => 'no',
                        'show-simple-check' => 'no',
                        'master_admin' => true,
                        'workspace' => 'yes',
                        'emails-count' => 8,
                        'status' => 'added',
                        'dkim-ready' => 'yes',
                        'logo_enabled' => 'yes',
                    ],
                ],
                'success' => 'ok',
                'on_page' => 20,
            ]),
        ];
    }
}
