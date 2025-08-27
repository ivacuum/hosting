<?php

namespace App\Http\Controllers;

use App\Domain\ImageConverter\ImageConverter;
use App\Http\Requests\ResizeImageForm;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Client\Factory;

class ResizeImageController
{
    public function __invoke(
        ResizeImageForm $request,
        Factory $http,
        ImageConverter $imageConverter,
    ) {
        $tempFile = tmpfile();
        $tempFilepath = stream_get_meta_data($tempFile)['uri'];

        try {
            $response = $http
                ->timeout(10)
                ->sink($tempFile)
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
