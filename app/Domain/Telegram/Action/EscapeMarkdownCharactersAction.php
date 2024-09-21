<?php

namespace App\Domain\Telegram\Action;

class EscapeMarkdownCharactersAction
{
    public function execute(string $text): string
    {
        return str_replace([
            '\\',
            '_',
            '*',
            '[',
            ']',
            '(',
            ')',
            '~',
            '`',
            '>',
            '#',
            '+',
            '-',
            '=',
            '|',
            '{',
            '}',
            '.',
            '!',
        ], [
            '\\\\',
            '\_',
            '\*',
            '\[',
            '\]',
            '\(',
            '\)',
            '\~',
            '\`',
            '\>',
            '\#',
            '\+',
            '\-',
            '\=',
            '\|',
            '\{',
            '\}',
            '\.',
            '\!',
        ], $text);
    }
}
