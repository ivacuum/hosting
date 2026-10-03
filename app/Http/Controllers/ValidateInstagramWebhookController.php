<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstagramWebhook;

class ValidateInstagramWebhookController
{
    public function __invoke(InstagramWebhook $request)
    {
        logs()->info('instagram.webhook_verification_requested', ['payload' => $request->all()]);

        return $request->challenge;
    }
}
