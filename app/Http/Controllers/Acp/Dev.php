<?php

namespace App\Http\Controllers\Acp;

use App\Http\Controllers\Controller;
use App\Trip;
use Breadcrumbs;
use Illuminate\Cookie\CookieJar;
use Illuminate\Http\Request;

class Dev extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        parent::__construct();

        $this->request = $request;
    }

    public function index()
    {
        return view($this->view);
    }

    public function debugbar(CookieJar $cookie)
    {
        $cookie->queue('debugbar', true, 60);
        $this->request->session()->flash('message', 'Debugbar включен на час');

        return redirect()->action("{$this->class}@index");
    }

    // Просмотр шаблона поездки
    public function template($template)
    {
        Breadcrumbs::push('Шаблоны поездок', 'acp/dev/templates');
        Breadcrumbs::push($template);

        $slug = str_replace('_', '.', $template);

        $trip = Trip::first();
        $next_trips = [];
        $previous_trips = [];

        $trip->slug = $slug;

        return view($this->view, compact('next_trips', 'previous_trips', 'template', 'trip'));
    }

    public function templates()
    {
        Breadcrumbs::push('Шаблоны поездок');

        $templates = [];

        foreach (glob(base_path('resources/views/life/trips/*.blade.php')) as $template) {
            $info = pathinfo($template);
            $filename = str_replace('.blade.php', '', $info['basename']);

            if ($filename == 'base') {
                continue;
            }

            $templates[] = $filename;
        }

        return view($this->view, compact('templates'));
    }

    public function svg()
    {
        $icons = [];

        foreach (glob(base_path('resources/views/tpl/svg/*.blade.php')) as $icon) {
            $info = pathinfo($icon);
            $filename = str_replace('.blade.php', '', $info['basename']);

            if ($filename == 'base') {
                continue;
            }

            $icons[] = $filename;
        }

        return view($this->view, compact('icons'));
    }

    public function thumbnails()
    {
        Breadcrumbs::push('Миниатюры');

        return view($this->view);
    }

    public function thumbnailsPost()
    {
        Breadcrumbs::push('Миниатюры');

        $files = $this->request->file('files', []);
        $format = $this->request->input('format', 'life');

        if (empty($files)) {
            throw new \Exception('Необходимо предоставить хотя бы один файл');
        }

        $sizes = [
            ['width' => 100,  'height' => 75,   'retina' => false],
            ['width' => 1000, 'height' => 750,  'retina' => false],
            ['width' => 2000, 'height' => 1500, 'retina' => true],
        ];

        $thumbnails = [];

        /* @var $file \Symfony\Component\HttpFoundation\File\UploadedFile */
        foreach ($files as $file) {
            if (is_null($file) || !$file->isValid()) {
                continue;
            }

            foreach ($sizes as $size) {
                $source = $file->getRealPath();
                $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $filename .= $size['retina'] ? '@2x' : '';
                $extension = $file->getClientOriginalExtension();

                $dir = "uploads/temp";

                if ($format === 'life' && $size['width'] === 100 && $size['height'] === 75) {
                    $dir .= "/t";
                }

                @mkdir($dir);

                $dest = "{$dir}/{$filename}.{$extension}";

                $exif = @exif_read_data($source, 'GPS');

                $coordinates = $this->processGps($exif);
                $lat = $lon = false;

                if (false !== $coordinates) {
                    $lat = $coordinates['lat'];
                    $lon = $coordinates['lon'];
                }

                passthru(sprintf(
                    '%s gm convert -size %dx%d "%s" %s -resize %dx%d\> +profile "*" "%s"',
                    escapeshellcmd('/usr/bin/env'),
                    $size['width'],
                    $size['height'],
                    $source,
                    $extension === 'jpg' ? '-quality 75' : '',
                    $size['width'],
                    $size['height'],
                    $dest
                ));

                $thumbnails[] = [
                    'dest' => $dest,
                    'lat'  => $lat,
                    'lon'  => $lon,
                ];
            }
        }

        return view($this->view, compact('thumbnails'));
    }

    /**
     * [GPSLatitudeRef] => N
     * [GPSLatitude] => Array
     *     (
     *         [0] => 53/1
     *         [1] => 1/1
     *         [2] => 4622/100
     *     )
     *
     * [GPSLongitudeRef] => E
     * [GPSLongitude] => Array
     *     (
     *         [0] => 129/1
     *         [1] => 43/1
     *         [2] => 1244/100
     *     )
     */
    protected function processGps($exif)
    {
        if (!isset($exif['GPSLatitude']) ||
            !isset($exif['GPSLongitude']) ||
            !isset($exif['GPSLatitudeRef']) ||
            !isset($exif['GPSLongitudeRef']) ||
            !in_array($exif['GPSLatitudeRef'], ['N', 'E', 'S', 'W']) ||
            !in_array($exif['GPSLongitudeRef'], ['N', 'E', 'S', 'W'])
        ) {
            return false;
        }

        $lat_ref = $exif['GPSLatitudeRef'];
        $lon_ref = $exif['GPSLongitudeRef'];

        $lat_degrees_ary = explode('/', $exif['GPSLatitude'][0]);
        $lat_minutes_ary = explode('/', $exif['GPSLatitude'][1]);
        $lat_seconds_ary = explode('/', $exif['GPSLatitude'][2]);
        $lon_degrees_ary = explode('/', $exif['GPSLongitude'][0]);
        $lon_minutes_ary = explode('/', $exif['GPSLongitude'][1]);
        $lon_seconds_ary = explode('/', $exif['GPSLongitude'][2]);

        $lat_degrees = $lat_degrees_ary[0] / $lat_degrees_ary[1];
        $lat_minutes = $lat_minutes_ary[0] / $lat_minutes_ary[1];
        $lat_seconds = $lat_seconds_ary[0] / $lat_seconds_ary[1];
        $lon_degrees = $lon_degrees_ary[0] / $lon_degrees_ary[1];
        $lon_minutes = $lon_minutes_ary[0] / $lon_minutes_ary[1];
        $lon_seconds = $lon_seconds_ary[0] / $lon_seconds_ary[1];

        $lat = (float) $lat_degrees + ($lat_minutes * 60 + $lat_seconds) / 3600;
        $lon = (float) $lon_degrees + ($lon_minutes * 60 + $lon_seconds) / 3600;

        $lat_ref == 'S' ? $lat *= -1 : false;
        $lon_ref == 'W' ? $lon *= -1 : false;

        $locale = localeconv();

        /* Обработка разделителей с учетом текущей локали */
        $lat = str_replace($locale['decimal_point'], '.', $lat);
        $lon = str_replace($locale['decimal_point'], '.', $lon);

        return compact('lat', 'lon');
    }
}
