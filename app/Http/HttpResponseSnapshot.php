<?php

namespace App\Http;

use Illuminate\Http\Client\Response;

class HttpResponseSnapshot
{
    /** @return array{body: string, reason: string, status: int, headers: array<string, list<string>>, version: string} */
    public static function fromResponse(Response $response): array
    {
        $psrResponse = $response->toPsrResponse();
        $stream = $psrResponse->getBody();
        $position = $stream->tell();

        try {
            $stream->rewind();
            $body = $stream->getContents();
        } finally {
            $stream->seek($position);
        }

        return [
            'body' => $body,
            'reason' => $psrResponse->getReasonPhrase(),
            'status' => $response->status(),
            'headers' => $response->headers(),
            'version' => $psrResponse->getProtocolVersion(),
        ];
    }

    /** @param array{body: string, reason: string, status: int, headers: array<string, list<string>>, version: string} $cachedResponse */
    public static function toResponse(array $cachedResponse): Response
    {
        $psrResponse = new \GuzzleHttp\Psr7\Response(
            $cachedResponse['status'],
            $cachedResponse['headers'],
            $cachedResponse['body'],
            $cachedResponse['version'],
            $cachedResponse['reason']
        );

        return new Response($psrResponse);
    }
}
