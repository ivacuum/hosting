<?php namespace App\Domain;

class ModelAccessibleRelation
{
    public function __construct(
        public readonly string $path,
        public readonly int $count,
        public readonly string $i18nIndex
    ) {
    }
}
