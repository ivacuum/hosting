<?php

namespace App\Http\Requests;

use App\Rules\HtmlFormInfrastructureRules;
use App\User;
use Illuminate\Foundation\Http\FormRequest;

class MagnetRequestReleaseForm extends FormRequest
{
    public User|null $user = null;
    public readonly string $q;
    public readonly string|null $comment;

    public function rules(): array
    {
        return [
            ...HtmlFormInfrastructureRules::rules(),
            'query' => 'required|string',
            'comment' => 'nullable|string',
        ];
    }

    #[\Override]
    protected function passedValidation()
    {
        $this->q = $this->input('query');
        $this->user = $this->user();
        $this->comment = $this->input('comment');
    }
}
