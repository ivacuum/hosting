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

        $keys = $credentials->keys()->all();
        $values = $credentials->values()->all();

        $http->path = str_replace($values, $keys, $http->path);
        $http->query = str_replace($values, $keys, $http->query);

        foreach ($http->request_headers ?? [] as $name => $headerValues) {
            if (strcasecmp($name, 'Authorization') === 0) {
                $http->request_headers[$name] = str_replace($values, $keys, $headerValues);
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
