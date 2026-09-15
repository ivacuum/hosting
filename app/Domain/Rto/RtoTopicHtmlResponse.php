<?php

namespace App\Domain\Rto;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

readonly class RtoTopicHtmlResponse
{
    public string $body;
    public string $announcer;

    public function __construct(public Response $response)
    {
        $html = $response->body();

        $this->body = $this->parseBodyHtml($html);
        $this->announcer = $this->parseAnnouncerLink($this->parseMagnetLink($html));
    }

    public static function fakeSuccess(string $body, string $announcer): PromiseInterface
    {
        return Factory::response(
            '<div class="post_body">' . $body
            . '<fieldset class="attach"><span class="attach_link">'
            . '<a class="magnet-link" href="magnet:?xt=urn:btih:0123456789abcdef0123456789abcdef01234567&tr='
            . urlencode($announcer) . '"></a></span></fieldset></div>',
            headers: ['Content-Type' => 'text/html; charset=UTF-8'],
        );
    }

    private function parseAnnouncerLink(string $magnetLink): string
    {
        parse_str($magnetLink, $args);

        return $args['tr'] ?? '';
    }

    private function parseBodyHtml(string $html): string
    {
        $body = preg_replace('/<fieldset class="attach">(.*?)<\/fieldset>/s', '', $html);

        $crawler = new Crawler($body);

        return Str::trim($crawler->filter('.post_body')->html());
    }

    private function parseMagnetLink(string $html): string
    {
        $crawler = new Crawler($html);

        if (count($link = $crawler->filter('.magnet-link')) === 0) {
            throw new RtoMagnetNotFoundException;
        }

        return $link->attr('href');
    }
}
