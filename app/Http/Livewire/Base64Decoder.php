<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Base64Decoder extends Component
{
    public string $input = 'SGVsbG8gd29ybGQh';

    public function decode(): string
    {
        return base64_decode($this->input);
    }
}
