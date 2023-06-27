<?php

namespace App\Services\YandexPdd;

use App\Action\FilterNullsAction;
use App\Http\HttpPost;
use App\Http\HttpRequest;
use Illuminate\Http\Client\Factory;

class YandexPddClient
{
    private const API_URL = 'https://pddimp.yandex.ru/api2/';

    private string $pddToken;

    public function __construct(private Factory $http, private FilterNullsAction $filterNulls)
    {
    }

    public function addDnsRecord(
        string $domain,
        DnsRecordType $type,
        string $subdomain,
        string $content,
        int $ttl = 3600
    ) {
        if (!$type->canBeAdded()) {
            throw new \DomainException('Unsupported dns record type.');
        }

        $request = new DnsRecordAddRequest($domain, $type, $subdomain, $ttl, $content);

        return new DnsRecordAddResponse($this->send($request));
    }

    public function addMxDnsRecord(
        string $domain,
        string $subdomain,
        string $content,
        int $priority = 10,
        int $ttl = 3600
    ) {
        $request = new DnsRecordAddRequest($domain, DnsRecordType::MX, $subdomain, $ttl, $content, $priority);

        return new DnsRecordAddResponse($this->send($request));
    }

    public function addSrvDnsRecord(
        string $domain,
        string $subdomain,
        string $target,
        int $weight,
        int $port,
        int $ttl = 3600
    ) {
        $request = new DnsRecordAddRequest(
            $domain,
            DnsRecordType::SRV,
            $subdomain,
            ttl: $ttl,
            weight: $weight,
            port: $port,
            target: idn_to_ascii($target, IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46)
        );

        return new DnsRecordAddResponse($this->send($request));
    }

    public function deleteDnsRecord(string $domain, int $id)
    {
        $request = new DnsRecordDeleteRequest($domain, $id);

        return new DnsRecordDeleteResponse($this->send($request));
    }

    public function dkimStatus(string $domain, bool $askSecretKey = false)
    {
        $request = new DkimStatusRequest($domain, $askSecretKey);

        return new DkimStatusResponse($this->send($request));
    }

    public function domains(int $page = 1)
    {
        $request = new DomainsRequest($page);

        return new DomainsResponse($this->send($request));
    }

    public function editDnsRecord(
        string $domain,
        int $id,
        DnsRecordType $type,
        string $subdomain,
        string $content,
        int $ttl = 3600
    ) {
        if (!$type->canBeAdded()) {
            throw new \DomainException('Unsupported dns record type.');
        }

        $request = new DnsRecordEditRequest($domain, $id, $type, $subdomain, $ttl, $content);

        return new DnsRecordEditResponse($this->send($request));
    }

    public function editMxDnsRecord(
        string $domain,
        int $id,
        string $subdomain,
        string $content,
        int $priority = 10,
        int $ttl = 3600
    ) {
        $request = new DnsRecordEditRequest($domain, $id, DnsRecordType::MX, $subdomain, $ttl, $content, $priority);

        return new DnsRecordEditResponse($this->send($request));
    }

    public function editSrvDnsRecord(
        string $domain,
        int $id,
        string $subdomain,
        string $target,
        int $weight,
        int $port,
        int $ttl = 3600
    ) {
        $request = new DnsRecordEditRequest(
            $domain,
            $id,
            DnsRecordType::SRV,
            $subdomain,
            ttl: $ttl,
            weight: $weight,
            port: $port,
            target: idn_to_ascii($target, IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46)
        );

        return new DnsRecordEditResponse($this->send($request));
    }

    public function emailAdd(string $domain, string $login, string $password)
    {
        $request = new EmailAddRequest($domain, $login, $password);

        return new EmailAddResponse($this->send($request));
    }

    public function emails(string $domain)
    {
        $request = new EmailsRequest($domain);

        return new EmailsResponse($this->send($request));
    }

    public function dnsRecords(string $domain)
    {
        $request = new DnsRecordsRequest($domain);

        return new DnsRecordsResponse($this->send($request));
    }

    public function setEmailPassword(string $domain, string $email, string $password)
    {
        $request = new EmailEditRequest($domain, $email, $password);

        return new EmailEditResponse($this->send($request));
    }

    public function token(string $token)
    {
        $yandexPdd = clone $this;
        $yandexPdd->pddToken = $token;

        return $yandexPdd;
    }

    private function configureClient()
    {
        return $this->http
            ->baseUrl(self::API_URL)
            ->timeout(10)
            ->withHeaders(['PddToken' => $this->pddToken]);
    }

    private function payload(HttpRequest $request)
    {
        $payload = $request->jsonSerialize();

        if (is_array($payload)) {
            return $this->filterNulls->execute($request->jsonSerialize());
        }

        return $payload;
    }

    private function send(HttpRequest $request)
    {
        if ($request instanceof HttpPost) {
            $response = $this->configureClient()
                ->bodyFormat('query')
                ->post($request->endpoint(), $this->payload($request));
        } else {
            $response = $this->configureClient()
                ->get($request->endpoint(), $this->payload($request));
        }

        if ($response->json('error')) {
            throw RequestException::make($response->json('error'));
        }

        return $response;
    }
}
