<?php namespace App\Http\Requests;

use App\Domain\TripStatus;
use App\Rules\TripSlug;
use Illuminate\Validation\Rule;
use Ivacuum\Generic\Http\FormRequest;

class TripUpdateForm extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var \App\User $user */
        /** @var \App\Trip $trip */
        $trip = $this->route('trip');
        $user = $this->user();

        return [
            'slug' => [
                'bail',
                'required',
                new TripSlug,
                Rule::unique('trips', 'slug')
                    ->where('user_id', $user->id)
                    ->ignore($trip->id ?? null),
            ],
            'status' => [
                'required',
                Rule::in([
                    TripStatus::HIDDEN,
                    TripStatus::INACTIVE,
                    TripStatus::PUBLISHED,
                ])
            ],
            'city_id' => 'required|integer|min:1',
            'markdown' => '',
            'title_ru' => null === $trip ? '' : 'required',
            'title_en' => null === $trip ? '' : 'required',
            'date_end' => 'required|date',
            'date_start' => 'required|date',
        ];
    }
}
