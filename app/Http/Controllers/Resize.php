<?php namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Str;
use Ivacuum\Generic\Services\ImageConverter;

class Resize extends Controller
{
    protected $whitelist = [
        'https://life.ivacuum.ru/',
        'https://life.ivacuum.org/',
    ];

    public function image($width, $height, Client $client)
    {
        $image = request('image');

        abort_unless($image, 404);

        $info = pathinfo($image);
        $extension = $info['extension'];

        abort_unless($this->isWhitelisted($info['dirname']), 403);

        // От 50 до 2000px
        $width = (int) min(2000, max(50, $width));
        $height = (int) min(2000, max(50, $height));

        $file = tmpfile();
        $source = stream_get_meta_data($file)['uri'];

        try {
            $response = $client->get($image, [
                'sink' => $file,
                'force_ip_resolve' => 'v4',
            ]);
        } catch (ClientException $e) {
            abort($e->getCode());
            exit;
        }

        $code = $response->getStatusCode();

        abort_unless($code === 200, $code);

        $newImage = (new ImageConverter)
            ->resize($width, $height)
            ->quality(75)
            ->convert($source);

        event(new \App\Events\Stats\ImageResizedOnDemand);

        header('Content-Type: ' . $this->mimeByExtension($extension));
        readfile($newImage->getRealPath());
        exit;
    }

    protected function isWhitelisted($uri)
    {
        foreach ($this->whitelist as $site) {
            if (Str::startsWith($uri, $site)) {
                return true;
            }
        }

        return false;
    }

    protected function mimeByExtension($ext)
    {
        switch ($ext) {
            case 'jpg': $type = 'image/jpeg'; break;
            case 'png': $type = 'image/png'; break;
        }

        return $type ?? 'image';
    }
}
