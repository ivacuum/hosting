<?php

namespace App\Utilities\LivewireForm;

class Textarea extends Base
{
    use HasPlaceholder;

    public bool $wide = false;
    public string $type = 'textarea';

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function html()
    {
        $tpl = $this->wide
            ? 'acp.tpl.livewire.input-textarea-wide'
            : 'acp.tpl.livewire.input';

        return view($tpl, $this->buildData());
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
