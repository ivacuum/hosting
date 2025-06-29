<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstagramWebhook;

class ValidateInstagramWebhookController
{
    public function __invoke(InstagramWebhook $request)
    {
        logs()->info('Instagram verify token payload: ' . json_encode($request->all(), \JSON_PRETTY_PRINT));

        return $request->challenge;
    }
}
