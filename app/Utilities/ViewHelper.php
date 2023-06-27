<?php

namespace App\Utilities;

use Ivacuum\Generic\Utilities\ViewHelper as BaseViewHelper;

class ViewHelper extends BaseViewHelper
{
    public function magnet(string $infoHash, string $announcer, string $title): string
    {
        return "magnet:?xt=urn:btih:{$infoHash}&tr=" . urlencode($announcer) . '&dn=' . rawurlencode($title);
    }

    public function pic(string $folder, string $file): string
    {
        return "https://life.ivacuum.org/-/1000x750/{$folder}/{$file}";
    }

    public function pic2x(string $folder, string $file): string
    {
        return "https://life.ivacuum.org/{$folder}/{$file}";
    }

    public function picArbitrary(int $width, int $height, string $folder, string $file): string
    {
        return "https://life.ivacuum.org/-/{$width}x{$height}/{$folder}/{$file}";
    }

    public function picThumb(string $folder, string $file): string
    {
        return "https://life.ivacuum.org/-/100x75/{$folder}/{$file}";
    }
}
