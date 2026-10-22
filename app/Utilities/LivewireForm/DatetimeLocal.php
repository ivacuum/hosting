<?php

namespace App\Utilities\LivewireForm;

use Illuminate\Contracts\View\View;

class DatetimeLocal extends Base
{
    public string $type = 'datetime-local';

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function html(): View
    {
        return view('acp.tpl.livewire.input', $this->buildData());
    }

    public function toHtml()
    {
        return $this->html();
    }
}
