<?php

namespace App\Utilities\LivewireForm;

use Illuminate\Contracts\Support\Arrayable;

trait HasManyValues
{
    public array $values = [];

    public function values($values): self
    {
        if ($values instanceof Arrayable) {
            $this->values = $values->toArray();
        } else {
            $this->values = $values;
        }

        return $this;
    }
}
