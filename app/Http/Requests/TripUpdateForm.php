<?php namespace App\Http\Requests;

use App\Domain\TripStatus;
use App\Rules\TripSlug;
use App\Trip;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

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
                Rule::unique(Trip::class, 'slug')
                    ->where('user_id', $user->id)
                    ->ignore($trip),
            ],
            'status' => [
                'required',
                new Enum(TripStatus::class),
            ],
            'city_id' => 'required|integer|min:1',
            'markdown' => '',
            'title_ru' => Rule::when($trip !== null, 'required'),
            'title_en' => Rule::when($trip !== null, 'required'),
            'date_end' => 'required|date',
            'date_start' => 'required|date',
        ];
    }
}
