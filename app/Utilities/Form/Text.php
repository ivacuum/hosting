<?php

namespace App\Utilities\Form;

class Text extends Base
{
    public $name;
    public $type = 'text';
    public $required = false;
    public $placeholder = '';

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function html()
    {
        return view('acp.tpl.input', $this->buildData());
    }

    public function placeholder(string $value): self
    {
        $this->placeholder = $value;

        return $this;
    }

    public function required(bool $value = true): self
    {
        $this->required = $value;

        return $this;
    }

    public function toHtml()
    {
        return $this->html();
    }
}
