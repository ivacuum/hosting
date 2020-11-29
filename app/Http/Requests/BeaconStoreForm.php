<?php namespace App\Http\Requests;

use Ivacuum\Generic\Http\FormRequest;

class BeaconStoreForm extends FormRequest
{
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

    public function sanitize(array $data): array
    {
        if (!empty($data['events'])) {
            $data['events'] = json_decode($data['events'], true);
        }

        return $data;
    }
}
