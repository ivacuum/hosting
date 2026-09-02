<?php

namespace App\Http;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

interface HttpRequest
{
    public function send(PendingRequest $http): Response;
}
