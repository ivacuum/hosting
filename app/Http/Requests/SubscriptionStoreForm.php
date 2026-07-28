<?php

namespace App\Http\Requests;

use App\Rules\Email;
use App\Rules\HtmlFormInfrastructureRules;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubscriptionStoreForm extends FormRequest
{
    public readonly User|null $user;
    public readonly string|null $email;
    public readonly array $selectedTopics;

    public function rules(): array
    {
        return [
            ...HtmlFormInfrastructureRules::rules(),
            'gigs' => 'in:0,1',
            'news' => 'in:0,1',
            'email' => Rule::when($this->user() === null, Email::rules()),
            'trips' => 'in:0,1',
        ];
    }

    #[\Override]
    protected function passedValidation(): void
    {
        $this->user = $this->user();
        $this->email = $this->input('email');
        $this->selectedTopics = array_keys(array_filter([
            'gigs' => $this->input('gigs'),
            'news' => $this->input('news'),
            'trips' => $this->input('trips'),
        ]));
    }
}
