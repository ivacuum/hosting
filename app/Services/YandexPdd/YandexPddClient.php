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

    public function addDnsRecord(
        string $pddToken,
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

        return new DnsRecordAddResponse($this->send($pddToken, $request));
    }

    public function addMxDnsRecord(
        string $pddToken,
        string $domain,
        string $subdomain,
        string $content,
        int $priority = 10,
        int $ttl = 3600
    ) {
        $request = new DnsRecordAddRequest($domain, DnsRecordType::MX, $subdomain, $ttl, $content, $priority);

        return new DnsRecordAddResponse($this->send($pddToken, $request));
    }

    public function addSrvDnsRecord(
        string $pddToken,
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

        return new DnsRecordAddResponse($this->send($pddToken, $request));
    }

    public function deleteDnsRecord(string $pddToken, string $domain, int $id)
    {
        $request = new DnsRecordDeleteRequest($domain, $id);

        return new DnsRecordDeleteResponse($this->send($pddToken, $request));
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

    public function editDnsRecord(
        string $pddToken,
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

        return new DnsRecordEditResponse($this->send($pddToken, $request));
    }

    public function editMxDnsRecord(
        string $pddToken,
        string $domain,
        int $id,
        string $subdomain,
        string $content,
        int $priority = 10,
        int $ttl = 3600
    ) {
        $request = new DnsRecordEditRequest($domain, $id, DnsRecordType::MX, $subdomain, $ttl, $content, $priority);

        return new DnsRecordEditResponse($this->send($pddToken, $request));
    }

    public function editSrvDnsRecord(
        string $pddToken,
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

        return new DnsRecordEditResponse($this->send($pddToken, $request));
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

    public function dnsRecords(string $pddToken, string $domain)
    {
        $request = new DnsRecordsRequest($domain);

        return new DnsRecordsResponse($this->send($pddToken, $request));
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
