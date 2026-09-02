<?php

namespace App\Domain\Wanikani\Api;

use App\Http\HttpRequest;
use Illuminate\Container\Attributes\Config;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

readonly class WanikaniApi
{
    public function __construct(
        private Factory $http,
        #[Config('services.wanikani.api_key')]
        private string $apiKey,
    ) {}

    public function subject(int $id): SubjectResponse
    {
        $request = new SubjectRequest($id);

        return new SubjectResponse($this->sendRequest($request));
    }

    public function subjects(int $level): SubjectsResponse
    {
        $request = new SubjectsRequest($level);

        return new SubjectsResponse($this->sendRequest($request));
    }

    private function http(): PendingRequest
    {
        return $this->http
            ->createPendingRequest()
            ->baseUrl('https://api.wanikani.com/v2/')
            ->connectTimeout(3)
            ->timeout(10)
            ->withToken($this->apiKey)
            ->withHeader('Wanikani-Revision', '20170710');
    }

    private function sendRequest(HttpRequest $request): Response
    {
        return $request->send($this->http());
    }
}
