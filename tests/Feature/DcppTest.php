<?php

namespace Tests\Feature;

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
            ->assertOk()
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

        $this->assertSame($clicks + 1, $hub->clicks);
    }

    #[\PHPUnit\Framework\Attributes\DataProvider('pages')]
    public function testPages(string $url)
    {
        $this->get($url)
            ->assertOk()
            ->assertHasCustomTitle();
    }

    public static function pages()
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
