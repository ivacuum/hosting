<?php

namespace App\Domain\Life\Action;

class ConvertTemplateImagesAction
{
    public function execute(string $content): string
    {
        $lines = explode("\n", str_replace("\r\n", "\n", $content));
        $images = $result = [];

        foreach ($lines as $line) {
            if (preg_match('#^([A-Za-z_\d]+\.[a-z]{3,4})$#', $line, $match)) {
                $images[] = str_replace('.jpeg', '.jpg', $match[1]);
            } else {
                $result = [...$result, ...$this->includeImages($images), $line];
                $images = [];
            }
        }

        return implode("\n", [...$result, ...$this->includeImages($images)]);
    }

    private function includeImages(array $images): array
    {
        return match (count($images)) {
            0 => [],
            1 => ["@include('tpl.pic-2x', ['pic' => '{$images[0]}'])"],
            default => [
                "@include('tpl.fotorama-2x', ['pics' => [",
                ...array_map(static fn (string $image) => "  '{$image}',", $images),
                ']])',
            ],
        };
    }
}
