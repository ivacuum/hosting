<?php

namespace App\Domain\Log\Action;

use Psr\Http\Message\StreamInterface;

class GetHttpBodyForLoggingAction
{
    public function execute(StreamInterface $stream, string $contentType, bool $skip = false): string
    {
        if ($skip || !$this->isText($contentType) || !$stream->isReadable() || !$stream->isSeekable()) {
            return '';
        }

        $position = $stream->tell();

        try {
            $stream->rewind();

            $body = $stream->getContents();
        } finally {
            $stream->seek($position);
        }

        if (mb_check_encoding($body) === false) {
            if (mb_check_encoding($body, 'windows-1251') === true) {
                return iconv('windows-1251', 'utf-8', $body);
            }

            return 'Not valid UTF-8.';
        }

        return $body;
    }

    private function isText(string $contentType): bool
    {
        $mediaType = strtolower(trim(explode(';', $contentType, 2)[0]));

        return str_starts_with($mediaType, 'text/')
            || str_ends_with($mediaType, '+json')
            || str_ends_with($mediaType, '+xml')
            || in_array($mediaType, [
                'application/json',
                'application/xml',
                'application/x-www-form-urlencoded',
            ], true);
    }
}
