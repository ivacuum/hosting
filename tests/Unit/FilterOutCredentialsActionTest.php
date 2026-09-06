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
        $request->host = 'graph.vacuum.name';
        $request->path = '/refresh_access_token';
        $request->query = 'access_token=secret';
        $request->service_name = ExternalService::Instagram;
        $request->request_headers = [];
        $request->response_body = $body;

        app(FilterOutCredentialsAction::class)->execute($request);

        $this->assertSame($body, $request->response_body);
        $this->assertSame('access_token=redacted', $request->query);
    }
}
