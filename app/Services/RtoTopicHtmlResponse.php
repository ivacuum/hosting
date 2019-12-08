<?php namespace App\Services;

use Symfony\Component\DomCrawler\Crawler;

class RtoTopicHtmlResponse
{
    private $body;
    private $announcer;

    public function __construct(string $html)
    {
        $this->body = $this->parseBodyHtml($html);
        $this->announcer = $this->parseAnnouncerLink($this->parseMagnetLink($html));
    }

    public function getAnnouncer(): string
    {
        return $this->announcer;
    }

    public function getBody(): string
    {
        return $this->body;
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

        return trim($crawler->filter('.post_body')->html());
    }

    private function parseMagnetLink(string $html): string
    {
        $crawler = new Crawler($html);

        if (sizeof($link = $crawler->filter('.attach_link a')) === 0) {
            throw new RtoMagnetNotFoundException;
        }

        return $link->attr('href');
    }
}
