<?php

namespace App\Domain\Telegram\Api;

enum ParseMode: string
{
    case Html = 'html';
    case Markdown = 'MarkdownV2';
}
