<?php

namespace App\Utilities\Form;

class Textarea extends Base
{
    public $name;
    public $type = 'textarea';
    public $wide = false;
    public $required = false;
    public $placeholder = '';

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function html()
    {
        $tpl = $this->wide ? 'input-textarea-wide' : 'input';

        return view("acp.tpl.$tpl", $this->buildData());
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

    public function wide(bool $value = true): self
    {
        $this->wide = $value;

        return $this;
    }
}
