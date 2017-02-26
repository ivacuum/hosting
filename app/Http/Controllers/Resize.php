<?php namespace App\Http\Controllers;

use App\Services\ImageConverter;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Resize extends Controller
{
    protected $whitelist = [
        'https://life.ivacuum.ru/',
    ];

    public function image($width, $height, Client $client)
    {
        $image = $this->request->input('image');

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
            $response = $client->get($image, ['sink' => $file]);
        } catch (ClientException $e) {
            abort($e->getCode());
        }

        $code = $response->getStatusCode();

        abort_unless($code === 200, $code);

        $new_image = (new ImageConverter())
            ->resize($width, $height)
            ->quality(75)
            ->convert($source);

        event(new \App\Events\Stats\ImageResizedOnDemand());

        header('Content-Type: ' . $this->mimeByExtension($extension));
        readfile($new_image->getRealPath());
        exit;
    }

    protected function isWhitelisted($uri)
    {
        foreach ($this->whitelist as $site) {
            if (starts_with($uri, $site)) {
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
