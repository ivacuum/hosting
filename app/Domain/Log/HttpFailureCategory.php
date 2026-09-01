<?php

namespace App\Domain\Log;

enum HttpFailureCategory: string
{
    case Connection = 'connection';
    case Dns = 'dns';
    case Timeout = 'timeout';
    case Tls = 'tls';
    case Transport = 'transport';
}
