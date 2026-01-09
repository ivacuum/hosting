<?php

namespace App\Utilities\LivewireForm;

trait HasPlaceholder
{
    public string $placeholder = '';

    public function placeholder(string $value): self
    {
        $this->placeholder = $value;

        return $this;
    }
}
