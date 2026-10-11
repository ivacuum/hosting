<?php

namespace Tests\Unit;

use App\Domain\Log\Action\FilterOutCredentialsAction;
use App\Domain\Log\ExternalService;
use App\Domain\Log\Models\ExternalHttpRequest;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class FilterOutCredentialsActionTest extends TestCase
{
    #[TestWith([''], 'empty body')]
    #[TestWith(['not json'], 'invalid JSON')]
    #[TestWith(['null'], 'JSON null')]
    #[TestWith(['"text"'], 'JSON string')]
    public function testLeavesUndecodableInstagramBodiesUnchanged(string $body): void
    {
        config(['services' => []]);

        $request = new ExternalHttpRequest;
        $request->scheme = 'https';
        $request->host = 'graph.instagram.com';
        $request->path = '/refresh_access_token';
        $request->query = 'access_token=secret';
        $request->service_name = ExternalService::Instagram;
        $request->request_headers = [];
        $request->response_body = $body;

        app(FilterOutCredentialsAction::class)->execute($request);

        $this->assertSame($body, $request->response_body);
        $this->assertSame('access_token=redacted', $request->query);
    }

    public function testOverlappingCredentialsAreFullyRedacted(): void
    {
        config(['services' => [
            'example' => [
                'api_key' => 'shared-secret',
                'access_token' => 'shared-secret-private-suffix',
            ],
        ]]);

        $request = new ExternalHttpRequest;
        $request->path = '/shared-secret-private-suffix';
        $request->query = 'key=shared-secret&token=shared-secret-private-suffix';
        $request->service_name = ExternalService::Example;
        $request->request_headers = ['Authorization' => ['Bearer shared-secret-private-suffix']];

        app(FilterOutCredentialsAction::class)->execute($request);

        $this->assertSame('/ExampleAccessToken', $request->path);
        $this->assertSame('key=ExampleApiKey&token=ExampleAccessToken', $request->query);
        $this->assertSame(['Bearer ExampleAccessToken'], $request->request_headers['Authorization']);
    }
}
