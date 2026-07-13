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
            '_token' => ['nullable'],
            'events' => ['required', 'array'],
            'events.*.event' => ['required', 'string'],
            'events.*.id' => ['nullable'],
            'events.*.slug' => ['nullable', 'string'],
        ];
    }

    #[\Override]
    protected function passedValidation()
    {
        $this->events = $this->collect('events')
            ->map(static fn ($payload) => BeaconEvent::fromArray($payload))
            ->all();
    }

    #[\Override]
    protected function prepareForValidation()
    {
        try {
            $this['events'] = json_decode($this->input('events'), true, flags: \JSON_THROW_ON_ERROR);
        } catch (\Throwable) {
            $this['events'] = [];
        }
    }
}
