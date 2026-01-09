<?php

namespace Tests\Feature;

use App\Events\Stats\Build;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpMetricsTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->get('acp/metrics')
            ->assertOk();
    }

    public function testShow()
    {
        $event = class_basename(Build::class);

        $this->get("acp/metrics/{$event}")
            ->assertOk();
    }
}
