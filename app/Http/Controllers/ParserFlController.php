<?php namespace App\Http\Controllers;

use GuzzleHttp\Client;

class ParserFlController
{
    public function __invoke(string $login, string $passwd)
    {
        $token = '';
        $userAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/600.6.3 (KHTML, like Gecko) Version/8.0.6 Safari/600.6.3';

        $client = new Client(['base_uri' => 'https://www.fl.ru/', 'cookies' => true]);

        // csrf token
        $response = $client->get('/');

        if (preg_match('/var _TOKEN_KEY = \'([a-z\d]+)\';/', $response->getBody(), $matches)) {
            $token = $matches[1];
        }

        // auth
        $client->post('/login/', [
            'headers' => ['User-Agent' => $userAgent],
            'form_params' => [
                'autologin' => 1,
                'login' => $login,
                'passwd' => $passwd,
                'u_token_key' => $token,
            ],
        ]);

        // go to profile to get rating
        $response = $client->get("/users/{$login}/rating", [
            'headers' => ['User-Agent' => $userAgent],
        ]);

        echo iconv('windows-1251', 'utf-8', $response->getBody());
        exit;
    }
}
