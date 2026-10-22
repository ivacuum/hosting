<?php

namespace App\Utilities\Form;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\View\View;

class Radio extends Base
{
    public $name;
    public $type = 'radio';
    public $values = [];
    public $required = false;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function html(): View
    {
        return view('acp.tpl.input', $this->buildData());
    }

    public function required(bool $value = true): self
    {
        $this->required = $value;

        return $this;
    }

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
