<?php

namespace App\Utilities\LivewireForm;

class Checkbox extends Base
{
    use HasManyValues;

    public string $type = 'checkbox';

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function html()
    {
        return view('acp.tpl.livewire.input', $this->buildData());
    }

    public function toHtml()
    {
        return $this->html();
    }
}
