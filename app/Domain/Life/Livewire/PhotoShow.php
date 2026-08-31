<?php

namespace App\Domain\Life\Livewire;

use App\Domain\Life\Models\Photo;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class PhotoShow extends Component
{
    public int|null $cityId = null;
    public int|null $countryId = null;
    public Photo|null $next = null;
    public Photo $photo;
    public Photo|null $prev = null;
    public int|null $tagId = null;
    public int|null $tripId = null;

    public function render(): View
    {
        return view('livewire.photo-show');
    }
}
