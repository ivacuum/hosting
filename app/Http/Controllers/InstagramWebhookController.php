<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstagramWebhookForm;

class InstagramWebhookController
{
    public function __invoke(InstagramWebhookForm $request)
    {
        logs()->info('instagram.webhook_received', ['payload' => $request->payload]);
    }
}
