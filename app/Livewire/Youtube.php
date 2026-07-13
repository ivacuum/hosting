<?php

namespace App\Livewire;

use Livewire\Component;

class Youtube extends Component
{
    public string $v;
    public string $title;
    public string $start;

    public function mount(int|null $start = null)
    {
        $this->start = $start
            ? "&start={$start}"
            : '';
    }
}
