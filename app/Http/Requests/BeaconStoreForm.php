<?php

namespace App\Http\Requests;

use App\Domain\BeaconEvent;
use Illuminate\Foundation\Http\FormRequest;

class BeaconStoreForm extends FormRequest
{
    /** @var array<int, BeaconEvent> */
    public readonly array $events;

    public function rules(): array
    {
        return [
            'events' => ['required', 'array'],
            'events.*.event' => ['required', 'string'],
        ];
    }

    protected function passedValidation()
    {
        $this->events = $this->collect('events')
            ->map(fn ($payload) => BeaconEvent::fromArray($payload))
            ->all();
    }

    protected function prepareForValidation()
    {
        try {
            $this['events'] = json_decode($this->input('events'), true, flags: \JSON_THROW_ON_ERROR);
        } catch (\Throwable) {
            $this['events'] = [];
        }
    }
}
