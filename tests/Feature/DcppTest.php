<?php namespace Tests\Feature;

use App\Factory\DcppHubFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DcppTest extends TestCase
{
    use DatabaseTransactions;

    public function testHublist()
    {
        $hub = DcppHubFactory::new()->create();

        $this->get('dc/hubs')
            ->assertStatus(200)
            ->assertSee($hub->externalLink())
            ->assertHasCustomTitle();
    }

    public function testHubClick()
    {
        $hub = DcppHubFactory::new()->create();
        $clicks = $hub->clicks;

        $this->post("dc/hubs/{$hub->id}/click")
            ->assertNoContent();

        $hub->refresh();

        $this->assertEquals($clicks + 1, $hub->clicks);
    }

    /**
     * @dataProvider pages
     * @param string $url
     */
    public function testPages(string $url)
    {
        $this->get($url)
            ->assertStatus(200)
            ->assertHasCustomTitle();
    }

    public function pages()
    {
        yield ['dc'];
        yield ['dc/airdc'];
        yield ['dc/apexdc'];
        yield ['dc/dcpp'];
        yield ['dc/faq'];
        yield ['dc/flylinkdc'];
        yield ['dc/greylinkdc'];
        yield ['dc/jucydc'];
        yield ['dc/kalugadc'];
        yield ['dc/pelinkdc'];
        yield ['dc/rus_setup'];
        yield ['dc/shakespeer'];
        yield ['dc/strongdc'];
        yield ['dc/strongdc_install'];
    }
}
