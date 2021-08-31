<?php namespace App\Services\Wanikani;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;

class WanikaniClient
{
    private string $apiKey;
    private PendingRequest $http;

    public function __construct(Factory $http)
    {
        $this->apiKey = config('cfg.wanikani_api_key');

        $this->http = $http
            ->baseUrl('https://api.wanikani.com/v2/')
            ->timeout(10);
    }

    public function subject(int $id)
    {
        $request = new SubjectRequest($id);

        return new SubjectResponse($this->send($request));
    }

    public function subjects(int $level)
    {
        $request = new SubjectsRequest($level);

        return new SubjectsResponse($this->send($request));
    }

    private function send(RequestInterface $request)
    {
        return $this->http
            ->withToken($this->apiKey)
            ->withHeaders(['Wanikani-Revision' => '20170710'])
            ->get($request->endpoint(), $request->jsonSerialize());
    }
}
