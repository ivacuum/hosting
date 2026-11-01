<?php

namespace App\Domain\Exif;

use Carbon\CarbonImmutable;

class GetExifValueForHumansAction
{
    public function __construct(private DivideExifValueAction $divideExifValue) {}

    public function execute(string $key, int|string|array|null $value): string
    {
        return match ($key) {
            'FileDateTime' => CarbonImmutable::parse($value)->toDateTimeString(),
            'FileSize' => \ViewHelper::size($value),
            'FileType' => match ($value) {
                2 => 'JPEG',
                default => '',
            },
            'Orientation' => match ($value) {
                1 => 'ОК',
                3 => 'Вверх ногами',
                6 => 'Повернуто на 90º против часовой стрелки',
                8 => 'Повернуто на 90º по часовой стрелке',
                default => '',
            },
            'ExposureMode' => match ($value) {
                0 => 'Автоматическая экспозиция',
                1 => 'Ручная экспозиция',
                2 => 'Автоматическая экспозиция с брекетингом',
                default => '',
            },
            'ExposureTime' => $this->withUnit($value, 'сек', 5),
            'FocalLength' => $this->withUnit($value, 'мм'),
            'FocalLengthIn35mmFilm' => match ($value) {
                24 => 'Основная камера, приближение 1x',
                default => '',
            },
            'GPSLatitudeRef' => match ($value) {
                'N' => 'Север',
                'S' => 'Юг',
                default => '',
            },
            'GPSLongitudeRef' => match ($value) {
                'W' => 'Запад',
                'E' => 'Восток',
                default => '',
            },
            'GPSAltitudeRef' => match ($value) {
                chr(0),
                0 => 'Выше уровня моря',
                chr(1),
                1 => 'Ниже уровня моря',
                default => '',
            },
            'GPSAltitude' => $this->meters($value),
            'GPSSpeedRef' => match ($value) {
                'K' => 'Километры в час',
                'M' => 'Мили в час',
                'N' => 'Узлы',
                default => '',
            },
            'GPSSpeed' => $this->withUnit($value, ''),
            'GPSImgDirection',
            'GPSDestBearing' => $this->withUnit($value, 'º'),
            'GPSImgDirectionRef' => match ($value) {
                'T' => 'Географический Северный полюс',
                'M' => 'Магнитный Северный полюс',
                default => '',
            },
            'SensingMethod' => match ($value) {
                1 => 'Not defined',
                2 => 'One-chip colour area sensor',
                3 => 'Two-chip colour area sensor',
                4 => 'Three-chip colour area sensor',
                5 => 'Colour sequential area sensor',
                7 => 'Trilinear sensor',
                8 => 'Colour sequential linear sensor',
                default => '',
            },
            'WhiteBalance' => match ($value) {
                0 => 'Автоматический баланс белого',
                1 => 'Ручной баланс белого',
                default => '',
            },
            default => '',
        };
    }

    private function divide(int|string|array|null $value, int $precision = 2): float|int|null
    {
        return is_string($value)
            ? $this->divideExifValue->execute($value, $precision)
            : null;
    }

    private function meters(int|string|array|null $value): string
    {
        $meters = $this->divide($value, 0);

        return $meters === null ? '' : \ViewHelper::plural('meters', (int) $meters);
    }

    private function withUnit(int|string|array|null $value, string $unit, int $precision = 2): string
    {
        $number = $this->divide($value, $precision);

        return $number === null ? '' : "{$number}{$unit}";
    }
}
