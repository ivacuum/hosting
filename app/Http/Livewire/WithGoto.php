<?php namespace App\Http\Livewire;

trait WithGoto
{
    public ?string $goto;

    public function mountWithGoto()
    {
        $this->goto = request('goto');
    }
}