<?php namespace App\Http\Livewire;

use Livewire\Component;

class HashGenerator extends Component
{
    public string $input = 'Hello world!';

    public function md5(): string
    {
        return md5($this->input);
    }

    public function sha1(): string
    {
        return sha1($this->input);
    }

    public function sha256(): string
    {
        return hash('sha256', $this->input);
    }

    public function sha512(): string
    {
        return hash('sha512', $this->input);
    }
}
