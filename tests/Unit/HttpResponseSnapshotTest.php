<?php

namespace Tests\Unit;

use App\Http\HttpResponseSnapshot;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;
use PHPUnit\Framework\TestCase;

class HttpResponseSnapshotTest extends TestCase
{
    public function testPreservesResponseFieldsAndCursorWithoutTransportState(): void
    {
        $response = new Response(Factory::psr7Response("\xFFbody", 201, ['X-Test' => 'value'])
            ->withProtocolVersion('1.0')
            ->withStatus(201, 'Custom reason'));
        $response->cookies = new CookieJar;
        $response->toPsrResponse()->getBody()->seek(2);

        $data = HttpResponseSnapshot::fromResponse($response);

        $this->assertSame(2, $response->toPsrResponse()->getBody()->tell());
        $this->assertSame([
            'body' => "\xFFbody",
            'reason' => 'Custom reason',
            'status' => 201,
            'headers' => ['X-Test' => ['value']],
            'version' => '1.0',
        ], $data);

        $cached = HttpResponseSnapshot::toResponse($data);

        $this->assertSame("\xFFbody", $cached->body());
        $this->assertSame(201, $cached->status());
        $this->assertSame($response->headers(), $cached->headers());
        $this->assertSame('1.0', $cached->toPsrResponse()->getProtocolVersion());
        $this->assertSame('Custom reason', $cached->toPsrResponse()->getReasonPhrase());
        $this->assertNull($cached->cookies());
    }
}
