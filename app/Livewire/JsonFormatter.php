<?php

namespace App\Livewire;

use Livewire\Component;

class JsonFormatter extends Component
{
    public string $json = '{"hello":"world"}';

    public function formattedJson()
    {
        try {
            return json_encode(json_decode($this->json, flags: \JSON_THROW_ON_ERROR), \JSON_PRETTY_PRINT | \JSON_UNESCAPED_UNICODE);
        } catch (\Throwable) {
            return 'Specified json is invalid. Please correct it.';
        }
    }
}
