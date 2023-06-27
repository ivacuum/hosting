<?php

namespace App\Domain;

readonly class ModelAccessibleRelation
{
    public function __construct(
        public string $path,
        public int $count,
        public string $i18nIndex
    ) {
    }
}
