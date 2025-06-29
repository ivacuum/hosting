<?php

namespace App\Http\Requests;

use App\Domain\Config;
use Illuminate\Foundation\Http\FormRequest;

class InstagramWebhook extends FormRequest
{
    public readonly bool $shouldIgnoreWebhook;
    public readonly string|null $challenge;

    public function rules(): array
    {
        return [
            'hub_mode' => 'required|string',
            'hub_challenge' => 'required',
            'hub_verify_token' => 'required|string',
        ];
    }

    #[\Override]
    protected function passedValidation()
    {
        $this->challenge = $this->input('hub_challenge');
        $this->shouldIgnoreWebhook = $this->input('hub_verify_token') !== Config::InstagramWebhookVerifyToken->get();
    }

    private function shouldIgnoreWebhook(): bool
    {
        try {
            $token = Config::InstagramWebhookVerifyToken->get();
        } catch (\InvalidArgumentException) {
            return true;
        }

        return $this->input('hub_verify_token') !== $token;
    }
}
