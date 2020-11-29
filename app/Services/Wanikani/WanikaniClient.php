<?php namespace App\Services\Wanikani;

use Ivacuum\Generic\Http\GuzzleClientFactory;

class WanikaniClient
{
    private $apiKey;
    private $client;

    public function __construct(GuzzleClientFactory $clientFactory)
    {
        $this->apiKey = config('cfg.wanikani_api_key');

        $this->client = $clientFactory
            ->baseUri('https://api.wanikani.com/v2/')
            ->timeout(10)
            ->withLog('wanikani')
            ->create();
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
        return $this->client->request(
            $request->httpMethod(),
            $request->endpoint(),
            [
                'headers' => [
                    'Authorization' => "Bearer {$this->apiKey}",
                    'Wanikani-Revision' => '20170710',
                ],
                'query' => $request->jsonSerialize(),
            ]
        );
    }
}
