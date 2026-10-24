<?php

namespace Tests\Unit;

use App\Domain\Life\Action\ConvertTemplateImagesAction;
use Tests\TestCase;

class ConvertTemplateImagesActionTest extends TestCase
{
    public function testConvertsCrlfImageLines(): void
    {
        $this->assertSame(
            "Intro.\n@include('tpl.pic-2x', ['pic' => 'IMG_0001.jpg'])\nOutro.",
            new ConvertTemplateImagesAction()->execute("Intro.\r\nIMG_0001.jpg\r\nOutro."),
        );
    }

    public function testConvertsImageLinesIntoIncludes(): void
    {
        $content = implode("\n", [
            'Intro.',
            'IMG_0001.jpeg',
            '',
            'IMG_0002.jpg',
            'IMG_0003.jpg',
            'Outro.',
        ]);

        $expected = implode("\n", [
            'Intro.',
            "@include('tpl.pic-2x', ['pic' => 'IMG_0001.jpg'])",
            '',
            "@include('tpl.fotorama-2x', ['pics' => [",
            "  'IMG_0002.jpg',",
            "  'IMG_0003.jpg',",
            ']])',
            'Outro.',
        ]);

        $this->assertSame($expected, new ConvertTemplateImagesAction()->execute($content));
    }

    public function testConvertsTrailingImageLines(): void
    {
        $this->assertSame(
            "Intro.\n@include('tpl.fotorama-2x', ['pics' => [\n  'IMG_0001.jpg',\n  'IMG_0002.jpg',\n]])",
            new ConvertTemplateImagesAction()->execute("Intro.\nIMG_0001.jpg\nIMG_0002.jpg"),
        );
    }
}
