<?php namespace App\Utilities;

class Size
{
    public function localized($bytes)
    {
        $units = [
            trans('size.b'),
            trans('size.kb'),
            trans('size.mb'),
            trans('size.gb'),
            trans('size.tb'),
        ];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, sizeof($units) - 1);
        $bytes /= pow(1024, $pow);

        return round($bytes, 1) . '&nbsp;' . $units[$pow];
    }
}
