<?php namespace App\Http;

use Illuminate\Http\Client\Response;

class CachedResponse implements \JsonSerializable
{
    public function __construct(private Response $response)
    {
    }

    public static function fromResponse(Response $response)
    {
        return new self($response);
    }

    public function jsonSerialize()
    {
        return [
            'body' => $this->response->body(),
            'reason' => $this->response->toPsrResponse()->getReasonPhrase(),
            'status' => $this->response->status(),
            'cookies' => $this->response->cookies(),
            'headers' => $this->response->headers(),
            'version' => $this->response->toPsrResponse()->getProtocolVersion(),
        ];
    }

    public static function toResponse(array $cachedResponse): Response
    {
        $psrResponse = new \GuzzleHttp\Psr7\Response(
            $cachedResponse['status'],
            $cachedResponse['headers'],
            $cachedResponse['body'],
            $cachedResponse['version'],
            $cachedResponse['reason']
        );

        $response = new Response($psrResponse);
        $response->cookies = $cachedResponse['cookies'];

        return $response;
    }
}
