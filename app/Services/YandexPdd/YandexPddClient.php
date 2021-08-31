<?php namespace App\Services\YandexPdd;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;

class YandexPddClient
{
    private PendingRequest $http;

    public function __construct(Factory $http)
    {
        $this->http = $http
            ->baseUrl('https://pddimp.yandex.ru/api2/')
            ->timeout(10);
    }

    public function dkimStatus(string $pddToken, string $domain, bool $askSecretKey = false)
    {
        $request = new DkimStatusRequest($domain, $askSecretKey);

        return new DkimStatusResponse($this->send($pddToken, $request));
    }

    private function send(string $pddToken, RequestInterface $request)
    {
        return $this->http
            ->withHeaders(['PddToken' => $pddToken])
            ->get($request->endpoint(), $request->jsonSerialize());
    }
}
