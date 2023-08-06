<?php

namespace App\Action\Telegram;

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
