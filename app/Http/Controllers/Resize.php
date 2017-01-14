<?php namespace App\Http\Controllers;

use GuzzleHttp\Client;

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

        $this->checkWhitelist($info['dirname']);

        // От 50 до 2000px
        $width = (int) min(2000, max(50, $width));
        $height = (int) min(2000, max(50, $height));

        $file = tmpfile();
        $source = stream_get_meta_data($file)['uri'];

        $response = $client->get($image, ['sink' => $file]);
        $code = $response->getStatusCode();

        abort_unless($code === 200, $code);

        $filename = str_random(6);
        $destination = "uploads/temp/{$filename}.{$extension}";

        register_shutdown_function(function () use ($destination) {
            unlink($destination);
        });

        passthru(sprintf(
            '%s gm convert -size %dx%d "%s" %s -resize %dx%d\> +profile "*" "%s"',
            escapeshellcmd('/usr/bin/env'),
            $width,
            $height,
            $source,
            $extension === 'jpg' ? '-quality 75' : '',
            $width,
            $height,
            $destination
        ));

        header('Content-Type: ' . $this->mimeByExtension($extension));
        readfile($destination);
        exit;
    }

    protected function checkWhitelist($uri)
    {
        foreach ($this->whitelist as $site) {
            if (starts_with($uri, $site)) {
                return true;
            }
        }

        abort(403);
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
