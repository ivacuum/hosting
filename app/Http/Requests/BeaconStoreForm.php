<?php namespace App\Http\Requests;

use App\Domain\BeaconEvent;
use Ivacuum\Generic\Http\FormRequest;

class BeaconStoreForm extends FormRequest
{
    /** @var array<int, BeaconEvent> */
    public readonly array $events;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'events' => ['required', 'array'],
            'events.*.event' => ['required', 'string'],
        ];
    }

    protected function passedValidation()
    {
        $this->events = collect($this->input('events'))
            ->map(fn ($payload) => BeaconEvent::fromArray($payload))
            ->all();
    }

    protected function prepareForValidation()
    {
        $this['events'] = json_decode($this->input('events'), true, flags: \JSON_THROW_ON_ERROR);
    }
}
