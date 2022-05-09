<?php namespace Tests\Feature;

use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Ivacuum\Generic\Events\Stats\Build;
use Tests\TestCase;

class AcpMetricsTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->be(UserFactory::new()->admin()->make());
    }

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
