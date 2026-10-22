<?php

namespace App\Livewire;

trait WithGoto
{
    public string|null $goto = null;

    public function mountWithGoto(): void
    {
        $this->goto = request('goto');
    }
}
