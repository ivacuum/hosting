<?php namespace App\Services\YandexPdd;

use App\Http\HttpPost;
use App\Http\HttpRequest;
use Illuminate\Http\Client\Factory;

class YandexPddClient
{
    private const API_URL = 'https://pddimp.yandex.ru/api2/';

    public function __construct(private Factory $http)
    {
    }

    public function dkimStatus(string $pddToken, string $domain, bool $askSecretKey = false)
    {
        $request = new DkimStatusRequest($domain, $askSecretKey);

        return new DkimStatusResponse($this->send($pddToken, $request));
    }

    public function domains(string $pddToken, int $page = 1)
    {
        $request = new DomainsRequest($page);

        return new DomainsResponse($this->send($pddToken, $request));
    }

    public function emailAdd(string $pddToken, string $domain, string $login, string $password)
    {
        $request = new EmailAddRequest($domain, $login, $password);

        return new EmailAddResponse($this->send($pddToken, $request));
    }

    public function emails(string $pddToken, string $domain)
    {
        $request = new EmailsRequest($domain);

        return new EmailsResponse($this->send($pddToken, $request));
    }

    public function setEmailPassword(string $pddToken, string $domain, string $email, string $password)
    {
        $request = new EmailEditRequest($domain, $email, $password);

        return new EmailEditResponse($this->send($pddToken, $request));
    }

    private function send(string $pddToken, HttpRequest $request)
    {
        if ($request instanceof HttpPost) {
            $response = $this->configureClient($pddToken)
                ->bodyFormat('query')
                ->post($request->endpoint(), $request->jsonSerialize());
        } else {
            $response = $this->configureClient($pddToken)
                ->get($request->endpoint(), $request->jsonSerialize());
        }

        if ($response->json('error')) {
            throw RequestException::make($response->json('error'));
        }

        return $response;
    }

    private function configureClient(string $pddToken)
    {
        return $this->http
            ->baseUrl(self::API_URL)
            ->timeout(10)
            ->withHeaders(['PddToken' => $pddToken]);
    }
}
