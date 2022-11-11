<?php namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Ivacuum\Generic\Events\Stats\Build;
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
