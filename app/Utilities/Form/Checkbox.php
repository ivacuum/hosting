<?php

namespace App\Utilities\Form;

use Illuminate\Contracts\View\View;

class Checkbox extends Base
{
    public $name;
    public $type = 'checkbox';
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

    public function values(array $values): self
    {
        $this->values = $values;

        return $this;
    }
}
