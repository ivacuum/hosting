<?php

namespace App\Utilities\LivewireForm;

use Illuminate\Contracts\Support\Htmlable;

class Radio extends Base implements Htmlable
{
    use HasManyValues;

    public string $type = 'radio';

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
