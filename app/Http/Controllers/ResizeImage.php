<?php namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Ivacuum\Generic\Services\ImageConverter;

class ResizeImage
{
    protected $whitelist = [
        'https://life.ivacuum.ru/',
        'https://life.ivacuum.org/',
    ];

    public function __invoke(int $width, int $height, Client $client)
    {
        $image = request('image');

        abort_unless($image, 404);

        $info = pathinfo($image);
        $extension = $info['extension'];

        abort_unless($this->isWhitelisted($info['dirname']), 403);

        // От 50 до 2000px
        $width = min(2000, max(50, $width));
        $height = min(2000, max(50, $height));

        $file = tmpfile();
        $source = stream_get_meta_data($file)['uri'];

        try {
            $response = $client->get($image, [
                'sink' => $file,
                'force_ip_resolve' => 'v4',
            ]);
        } catch (ClientException $e) {
            abort($e->getCode());
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
            if (str_starts_with($uri, $site)) {
                return true;
            }
        }

        return false;
    }

    protected function mimeByExtension($ext)
    {
        $type = match ($ext) {
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
        };

        return $type ?? 'image';
    }
}
