<?php namespace App\Services\YandexPdd;

use App\Http\GuzzleClientFactory;

class YandexPddClient
{
    private $client;

    public function __construct(GuzzleClientFactory $clientFactory)
    {
        $this->client = $clientFactory
            ->baseUri('https://pddimp.yandex.ru/api2/')
            ->timeout(10)
            ->withLog('yandex-pdd')
            ->create();
    }

    public function dkimStatus(string $pddToken, string $domain, bool $askSecretKey = false)
    {
        $request = new DkimStatusRequest($domain, $askSecretKey);

        return new DkimStatusResponse($this->send($pddToken, $request));
    }

    private function send(string $pddToken, RequestInterface $request)
    {
        return $this->client->request(
            $request->httpMethod(),
            $request->endpoint(),
            [
                'headers' => ['PddToken' => $pddToken],
                'query' => $request->httpMethod() === 'GET'
                    ? $request->jsonSerialize()
                    : [],
            ]
        );
    }
}
