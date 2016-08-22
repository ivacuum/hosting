<?php namespace App\Http\Controllers;

use App\Page;
use GuzzleHttp\Client;

class ParserFl extends Controller
{
    public function index($login, $passwd)
    {
        $autologin   = 1;
        $u_token_key = '';
        $user_agent  = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/600.6.3 (KHTML, like Gecko) Version/8.0.6 Safari/600.6.3';

        $client = new Client(['base_uri' => 'https://www.fl.ru/', 'cookies' => true]);

        // csrf token
        $response = $client->get('/');

        if (preg_match('/var _TOKEN_KEY = \'([a-z\d]+)\';/', $response->getBody(), $matches)) {
            $u_token_key = $matches[1];
        }

        // auth
        $client->post('/login/', [
            'headers' => ['User-Agent' => $user_agent],
            'form_params' => compact('autologin', 'login', 'passwd', 'u_token_key'),
        ]);

        // go to profile to get rating
        $response = $client->get("/users/{$login}/rating", [
            'headers' => ['User-Agent' => $user_agent],
        ]);

        print iconv('windows-1251', 'utf-8', $response->getBody());
        exit;
    }
}
