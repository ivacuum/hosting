<?php

namespace App\Domain\Log\Action;

use App\Domain\Log\ExternalService;
use App\Domain\Log\Models\ExternalHttpRequest;

class FilterOutCredentialsAction
{
    public function __construct(private GetAllCredentialsAction $getAllCredentials) {}

    public function execute(ExternalHttpRequest $http)
    {
        $credentials = $this->getAllCredentials->execute();

        $replacements = array_combine($credentials->values()->all(), $credentials->keys()->all());

        foreach ($credentials as $name => $credential) {
            $replacements[rawurlencode($credential)] = $name;
            $replacements[urlencode($credential)] = $name;
        }

        $http->path = strtr($http->path, $replacements);
        $http->query = strtr($http->query, $replacements);

        foreach ($http->request_headers ?? [] as $name => $headerValues) {
            if (strcasecmp($name, 'Authorization') === 0) {
                $http->request_headers[$name] = array_map(
                    static fn (string $value): string => strtr($value, $replacements),
                    $headerValues,
                );
            }
        }

        match ($http->service_name) {
            ExternalService::Instagram => $this->instagram($http),
            default => null,
        };
    }

    private function instagram(ExternalHttpRequest $http)
    {
        $http->query = $http
            ->toUri()
            ->withQuery(['access_token' => 'redacted'])
            ->query()
            ->decode();

        if (str_contains($http->path, 'refresh_access_token')) {
            $json = json_decode($http->response_body, true);

            if (!is_array($json)) {
                return;
            }

            $json['access_token'] = 'redacted';

            $http->response_body = json_encode($json);
        }
    }
}
