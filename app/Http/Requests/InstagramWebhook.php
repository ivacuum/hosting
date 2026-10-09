<?php

namespace App\Http\Requests;

use App\Domain\Config;
use Illuminate\Foundation\Http\FormRequest;

class InstagramWebhook extends FormRequest
{
    public readonly string|null $challenge;

    public function authorize(): bool
    {
        try {
            $expectedToken = Config::InstagramWebhookVerifyToken->get();
        } catch (\InvalidArgumentException) {
            return false;
        }

        $providedToken = $this->input('hub_verify_token');

        return $expectedToken !== ''
            && is_string($providedToken)
            && hash_equals($expectedToken, $providedToken);
    }

    public function rules(): array
    {
        return [
            'hub_mode' => 'required|string',
            'hub_challenge' => 'required',
            'hub_verify_token' => 'required|string',
        ];
    }

    #[\Override]
    protected function passedValidation(): void
    {
        $this->challenge = $this->input('hub_challenge');
    }
}
