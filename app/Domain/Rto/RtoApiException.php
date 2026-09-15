<?php

namespace App\Domain\Rto;

class RtoApiException extends \RuntimeException
{
    /** @param array{code: int, text: string} $error */
    public static function fromError(array $error): self
    {
        if ($error['code'] === 1 && $error['text'] === 'Temporarily disabled') {
            return new RtoTemporarilyUnavailableException($error['text'], $error['code']);
        }

        return new self($error['text'], $error['code']);
    }
}
