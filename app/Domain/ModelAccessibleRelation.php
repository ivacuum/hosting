<?php namespace App\Domain;

class ModelAccessibleRelation implements \JsonSerializable
{
    public function __construct(
        public readonly string $path,
        public readonly int $count,
        public readonly string $i18nIndex
    ) {
    }

    public function jsonSerialize()
    {
        return [
            'path' => $this->path,
            'count' => $this->count,
            'i18n_index' => $this->i18nIndex,
        ];
    }
}
