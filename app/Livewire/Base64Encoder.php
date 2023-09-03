<?php

namespace App\Livewire;

use Livewire\Component;

class Base64Encoder extends Component
{
    public string $input = 'Hello world!';

    public function encode(): string
    {
        return base64_encode($this->input);
    }
}
