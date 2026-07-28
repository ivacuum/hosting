<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class SubscriptionConfirmForm extends FormRequest
{
    public readonly User $user;
    public readonly string $hash;

    public function rules(): array
    {
        return [];
    }

    #[\Override]
    protected function passedValidation(): void
    {
        $this->hash = $this->input('hash');
        $this->user = $this->user();
    }
}
