<?php

namespace App\Services;

class Breadcrumbs
{
    protected $breadcrumbs = [];

    public function get(): array
    {
        return $this->breadcrumbs;
    }

    public function pop(): self
    {
        array_pop($this->breadcrumbs);

        return $this;
    }

    public function push(string $title, string|null $url = null): self
    {
        $this->breadcrumbs[] = [
            'url' => $url,
            'title' => $title,
        ];

        return $this;
    }
}
