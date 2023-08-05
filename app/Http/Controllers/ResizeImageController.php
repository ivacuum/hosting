<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResizeImageForm;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Client\Factory;
use Ivacuum\Generic\Services\ImageConverter;

class ResizeImageController
{
    public function __invoke(Client $client, ResizeImageForm $request, Factory $http, ImageConverter $imageConverter)
    {
        $tempFile = tmpfile();
        $tempFilepath = stream_get_meta_data($tempFile)['uri'];

        try {
            $response = $http
                ->timeout(10)
                ->sink($tempFile)
                ->withOptions(['force_ip_resolve' => 'v4'])
                ->get($request->image);
        } catch (ClientException $e) {
            abort($e->getCode());
        }

        abort_unless($response->ok(), $response->status());

        $resizedImage = $imageConverter
            ->resize($request->width, $request->height)
            ->quality(75)
            ->convert($tempFilepath);

        event(new \App\Events\Stats\ImageResizedOnDemand);

        return response()->file($resizedImage, ['Content-Type' => $request->mimeByExtension()]);
    }
}
