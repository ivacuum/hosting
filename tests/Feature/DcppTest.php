<?php

namespace Tests\Feature;

use App\Domain\Dcpp\Factory\DcppHubFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class DcppTest extends TestCase
{
    use DatabaseTransactions;

    public function testHubClick()
    {
        $hub = DcppHubFactory::new()->create();
        $clicks = $hub->clicks;

        $this->post("dc/hubs/{$hub->id}/click")
            ->assertNoContent();

        $hub->refresh();

        $this->assertSame($clicks + 1, $hub->clicks);
    }

    public function testHubList()
    {
        $hub = DcppHubFactory::new()->create();

        $this->get('dc/hubs')
            ->assertOk()
            ->assertSee($hub->externalLink())
            ->assertHasCustomTitle();
    }

    #[TestWith(['dc'])]
    #[TestWith(['dc/airdc'])]
    #[TestWith(['dc/apexdc'])]
    #[TestWith(['dc/dcpp'])]
    #[TestWith(['dc/faq'])]
    #[TestWith(['dc/flylinkdc'])]
    #[TestWith(['dc/greylinkdc'])]
    #[TestWith(['dc/jucydc'])]
    #[TestWith(['dc/kalugadc'])]
    #[TestWith(['dc/pelinkdc'])]
    #[TestWith(['dc/rus_setup'])]
    #[TestWith(['dc/shakespeer'])]
    #[TestWith(['dc/strongdc'])]
    #[TestWith(['dc/strongdc_install'])]
    public function testPages(string $url)
    {
        $this->get($url)
            ->assertOk()
            ->assertHasCustomTitle();
    }
}
