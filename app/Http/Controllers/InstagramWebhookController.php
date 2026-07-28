<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstagramWebhookForm;

class InstagramWebhookController
{
    public function __invoke(InstagramWebhookForm $request)
    {
        logs()->info('Instagram event payload: ' . json_encode($request->payload, \JSON_PRETTY_PRINT));
    }
}
