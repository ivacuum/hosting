<?php

namespace App\Domain\Dcpp;

readonly class DcppHubInfo
{
    public function __construct(
        public bool $isOnline,
        public string|null $title = null,
    ) {}
}
