<?php namespace App\Action;

use GuzzleHttp\Client;

class FetchRobotsTxtAction
{
    public function __construct(private Client $http)
    {
    }

    public function execute(string $domain)
    {
        $domain = idn_to_ascii($domain, IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46);

        try {
            $response = $this->http->get("http://{$domain}/robots.txt");
        } catch (\Throwable $e) {
            return $e->getMessage();
        }

        return $response->getBody();
    }
}
