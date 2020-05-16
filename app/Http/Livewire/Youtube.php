<?php namespace App\Http\Livewire;

use Livewire\Component;

class Youtube extends Component
{
    public bool $expanded = false;
    public string $v;
    public string $title;
    public string $start;

    public function expand()
    {
        $this->expanded = true;

        event(new \App\Events\Stats\YoutubeOpened);
    }

    public function mount(string $v, string $title, int $start = null)
    {
        $this->v = $v;
        $this->title = $title;
        $this->start = $start
            ? "&start={$start}"
            : '';
    }

    public function shrink()
    {
        $this->expanded = false;

        event(new \App\Events\Stats\YoutubeClosed);
    }
}
