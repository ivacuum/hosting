<?php

namespace App\Http\Requests;

use App\Rules\HtmlFormInfrastructureRules;
use App\User;
use Illuminate\Foundation\Http\FormRequest;

class SubscriptionUpdateForm extends FormRequest
{
    public readonly User $user;
    public readonly bool|null $gigs;
    public readonly bool|null $news;
    public readonly bool|null $trips;

    public function rules(): array
    {
        return [
            ...HtmlFormInfrastructureRules::rules(),
            'gigs' => 'in:0,1',
            'news' => 'in:0,1',
            'trips' => 'in:0,1',
        ];
    }

    #[\Override]
    protected function passedValidation(): void
    {
        $this->gigs = $this->filled('gigs') ? $this->boolean('gigs') : null;
        $this->news = $this->filled('news') ? $this->boolean('news') : null;
        $this->user = $this->user();
        $this->trips = $this->filled('trips') ? $this->boolean('trips') : null;
    }
}
