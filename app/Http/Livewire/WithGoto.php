<?php

namespace App\Http\Livewire;

trait WithGoto
{
    public string|null $goto = null;

    public function mountWithGoto()
    {
        $this->goto = request('goto');
    }
}
