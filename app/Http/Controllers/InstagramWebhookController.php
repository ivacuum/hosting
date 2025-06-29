<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstagramWebhookController
{
    public function __invoke(Request $request)
    {
        logs()->info('Instagram event payload: ' . json_encode($request->all(), \JSON_PRETTY_PRINT));
    }
}
