<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

abstract class AbstractJob implements ShouldQueue
{
    use Queueable;

    public $tries;
    public $backoff;
    public $timeout;
    public $maxExceptions;
}
