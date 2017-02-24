<?php namespace App\Services;

use Illuminate\Http\UploadedFile;

/**
 * Конвертер изображений с помощью библиотеки GraphicsMagick
 */
class ImageConverter
{
    protected $auth_orient;
    protected $crop;
    protected $filter;
    protected $filters = ['point', 'box', 'triangle', 'hermite', 'hanning', 'hamming', 'blackman', 'gaussian', 'quadratic', 'cubic', 'catrom', 'mitchell', 'lanczos', 'bessel', 'sinc'];
    protected $first_frame;
    protected $gravity;
    protected $gravities = ['northwest', 'north', 'northeast', 'west', 'center', 'east', 'southwest', 'south', 'southeast'];
    protected $quality;
    protected $resize;
    protected $size;

    /**
     * Автоматическое определение ориентации снимка
     *
     * @return $this
     */
    public function autoOrient()
    {
        $this->auth_orient = '-auto-orient';

        return $this;
    }

    /**
     * Параметры нужно внимательно экранировать, например, \\>
     *
     * Но: звездочку +profile "*" экранировать не нужно, иначе в изображении останутся профили
     *
     * @param  string  $source Путь к исходному файлу
     * @return \Illuminate\Http\UploadedFile
     * @throws \Exception
     */
    public function convert($source)
    {
        $destination = $this->tempFile();

        $command = implode(' ', [
            config('cfg.gm_bin'),
            'convert',
            $this->size,
            escapeshellarg($this->source($source)),
            $this->auth_orient,
            $this->quality,
            $this->filter, // Фильтр должен быть перед resize
            $this->resize,
            $this->gravity,
            $this->crop,
            '+profile "*"',
            escapeshellarg($destination),
        ]);

        passthru($command);

        if (!file_exists($destination)) {
            throw new \Exception('Преобразование файла не удалось');
        }

        return new UploadedFile($destination, basename($source));
    }

    public function crop($width, $height)
    {
        $this->crop = "-crop {$width}x{$height}+0+0";
        $this->gravity('center');
        $this->resize($width, $height, '^');

        return $this;
    }

    /**
     * Фильтр для размыливания
     *
     * @param  string  $filter
     * @return $this
     * @throws \Exception
     */
    public function filter($filter)
    {
        if (!in_array($filter, $this->filters)) {
            throw new \Exception("Фильтр [{$filter}] не найден");
        }

        $this->filter = "-filter {$filter}";

        return $this;
    }

    /**
     * Первый кадр gif для миниатюры
     *
     * @return $this
     */
    public function firstFrame()
    {
        $this->first_frame = true;

        return $this;
    }

    public function gravity($gravity)
    {
        $gravity = strtolower($gravity);

        if (!in_array($gravity, $this->gravities)) {
            throw new \Exception("Фильтр [{$gravity}] не найден");
        }

        $this->gravity = "-gravity {$gravity}";

        return $this;
    }

    /**
     * Размеры миниатюры
     *
     * @param  integer $width
     * @param  integer $height
     * @param  string  $mark
     * @return $this
     */
    public function resize($width, $height, $mark = '>')
    {
        $this->size = "-size {$width}x{$height}";
        $this->resize = "-resize '{$width}x{$height}{$mark}'";

        return $this;
    }

    /**
     * Путь к файлу-исходнику. Для gif берется первый кадр
     *
     * @param  string $source
     * @return string
     */
    public function source($source)
    {
        if ($this->first_frame) {
            return "{$source}[0]";
        }

        return $source;
    }

    /**
     * Качество jpg на выходе
     *
     * @param  integer $quality 1–100
     * @return $this
     */
    public function quality($quality)
    {
        $this->quality = "-quality {$quality}";

        return $this;
    }

    /**
     * Результат работы конвертера будет помещен во временный файл, который будет удален по завершении запроса
     * Временный файл после преобразований подразумевается перенести в постоянное хранилище
     *
     * @return string
     */
    protected function tempFile()
    {
        $filename = str_random(6);
        $destination = storage_path("app/resize-{$filename}");

        register_shutdown_function(function () use ($destination) {
            unlink($destination);
        });

        return $destination;
    }
}
