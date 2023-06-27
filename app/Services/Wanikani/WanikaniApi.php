<?php

namespace App\Services\Wanikani;

use App\Http\HttpRequest;
use Illuminate\Http\Client\Factory;

class WanikaniApi
{
    private readonly string $apiKey;

    public function __construct(private Factory $http)
    {
        $this->apiKey = config('services.wanikani.api_key');
    }

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
            ->withHeaders(['Wanikani-Revision' => '20170710']);
    }

    private function sendRequest(HttpRequest $request)
    {
        return $this->configureClient()
            ->get($request->endpoint(), $request->jsonSerialize());
    }
}
