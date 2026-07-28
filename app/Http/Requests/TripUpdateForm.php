<?php

namespace App\Http\Requests;

use App\Domain\Life\Models\Trip;
use App\Domain\Life\Rule\TripSlug;
use App\Domain\Life\TripStatus;
use App\Rules\HtmlFormInfrastructureRules;
use App\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Container\Attributes\RouteParameter;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class TripUpdateForm extends FormRequest
{
    public readonly int $cityId;
    public readonly string $slug;
    public readonly string $dateEnd;
    public readonly string $dateStart;
    public readonly TripStatus $status;
    public readonly string|null $titleEn;
    public readonly string|null $titleRu;
    public readonly string|null $markdown;

    public function rules(
        #[RouteParameter('trip')] Trip|null $trip,
        #[CurrentUser] User $user,
    ): array {
        return [
            ...HtmlFormInfrastructureRules::rules(),
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
            'markdown' => ['nullable', 'string'],
            'title_ru' => [Rule::requiredIf($trip !== null), 'nullable', 'string'],
            'title_en' => [Rule::requiredIf($trip !== null), 'nullable', 'string'],
            'date_end' => 'required|date|after_or_equal:date_start',
            'date_start' => 'required|date',
        ];
    }

    #[\Override]
    protected function passedValidation(): void
    {
        $this->slug = $this->input('slug');
        $this->cityId = $this->integer('city_id');
        $this->status = $this->enum('status', TripStatus::class);
        $this->dateEnd = $this->input('date_end');
        $this->titleEn = $this->input('title_en');
        $this->titleRu = $this->input('title_ru');
        $this->markdown = $this->input('markdown');
        $this->dateStart = $this->input('date_start');
    }
}
