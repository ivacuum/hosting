<?php namespace App\Services;

use Symfony\Component\DomCrawler\Crawler;

class RtoTopicHtmlResponse
{
    public string $body;
    public string $announcer;

    public function __construct(string $html)
    {
        $this->body = $this->parseBodyHtml($html);
        $this->announcer = $this->parseAnnouncerLink($this->parseMagnetLink($html));
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

        if (count($link = $crawler->filter('.magnet-link')) === 0) {
            throw new RtoMagnetNotFoundException;
        }

        return $link->attr('href');
    }
}
