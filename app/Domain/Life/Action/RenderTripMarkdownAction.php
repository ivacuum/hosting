<?php

namespace App\Domain\Life\Action;

use App\Utilities\TextImagesParser;
use League\CommonMark\CommonMarkConverter;

class RenderTripMarkdownAction
{
    public function __construct(private TextImagesParser $textImagesParser) {}

    public function execute(string $markdown): string
    {
        $converter = new CommonMarkConverter([
            'html_input' => 'strip',
            'max_nesting_level' => 15,
            'allow_unsafe_links' => false,
        ]);

        $html = $converter->convert($markdown)->getContent();

        return preg_replace_callback(
            '#<p>((?:https?://[A-Za-z_\d/.-]+\.(?:jpe?g|png)\n?)+)</p>#',
            fn (array $matches): string => $this->textImagesParser->parse($matches[1]),
            $html,
        );
    }
}
