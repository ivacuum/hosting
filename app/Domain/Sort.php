<?php namespace App\Domain;

class Sort
{
    public function __construct(
        public readonly string $key,
        public readonly SortDirection $direction
    ) {
    }

    public static function asc(string $key): self
    {
        return new self($key, SortDirection::Asc);
    }

    public static function desc(string $key): self
    {
        return new self($key, SortDirection::Desc);
    }

    public function toString(): string
    {
        return $this->direction === SortDirection::Asc
            ? $this->key
            : "-{$this->key}";
    }
}
