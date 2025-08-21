<?php

namespace App\Http\Requests;

use App\Domain\Life\Models\Trip;
use App\Domain\Life\Rule\TripSlug;
use App\Domain\Life\TripStatus;
use App\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Container\Attributes\RouteParameter;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class TripUpdateForm extends FormRequest
{
    public function rules(
        #[RouteParameter('trip')] Trip|null $trip,
        #[CurrentUser] User $user,
    ): array {
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
            'title_ru' => Rule::requiredIf($trip !== null),
            'title_en' => Rule::requiredIf($trip !== null),
            'date_end' => 'required|date',
            'date_start' => 'required|date',
        ];
    }
}
