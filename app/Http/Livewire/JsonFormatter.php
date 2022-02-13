<?php namespace App\Http\Livewire;

use Livewire\Component;

class JsonFormatter extends Component
{
    public string $json = '{"hello":"world"}';

    public function formattedJson()
    {
        try {
            return json_encode(json_decode($this->json, flags: \JSON_THROW_ON_ERROR), \JSON_PRETTY_PRINT);
        } catch (\Throwable) {
            return 'Specified json is invalid. Please correct it.';
        }
    }

    public function rules()
    {
        return [
            'json' => [
                'required',
                'json',
            ],
        ];
    }
}
