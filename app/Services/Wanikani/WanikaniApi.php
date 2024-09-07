<?php

namespace App\Services\Wanikani;

use App\Http\HttpRequest;
use Illuminate\Container\Attributes\Config;
use Illuminate\Http\Client\Factory;

class WanikaniApi
{
    public function __construct(
        private Factory $http,
        #[Config('services.wanikani.api_key')]
        private readonly string $apiKey,
    ) {}

    public function subject(int $id)
    {
        $request = new SubjectRequest($id);

        return new SubjectResponse($this->sendRequest($request));
    }

    public function subjects(int $level)
    {
        $request = new SubjectsRequest($level);

        return new SubjectsResponse($this->sendRequest($request));
    }

    private function configureClient()
    {
        return $this->http
            ->baseUrl('https://api.wanikani.com/v2/')
            ->timeout(10)
            ->withToken($this->apiKey)
            ->withHeader('Wanikani-Revision', '20170710');
    }

    private function sendRequest(HttpRequest $request)
    {
        return $this->configureClient()
            ->get($request->endpoint(), $request->jsonSerialize());
    }
}
