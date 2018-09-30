<?php namespace Tests\Feature;

use App\DcppHub;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DcppTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->get(action('Dcpp@index'))
            ->assertStatus(200);
    }

    public function testHublist()
    {
        factory(DcppHub::class)->create();

        $this->get(action('DcppHubs@index'))
            ->assertStatus(200);
    }

    public function testHubClick()
    {
        /* @var DcppHub $hub */
        $hub = factory(DcppHub::class)->create();
        $clicks = $hub->clicks;

        $this->post(action('DcppHubClick@store', $hub))
            ->assertStatus(204);

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
            ->assertStatus(200);
    }

    public function pages()
    {
        return [
            ['/dc/airdc'],
            ['/dc/apexdc'],
            ['/dc/dcpp'],
            ['/dc/faq'],
            ['/dc/flylinkdc'],
            ['/dc/greylinkdc'],
            ['/dc/jucydc'],
            ['/dc/kalugadc'],
            ['/dc/pelinkdc'],
            ['/dc/rus_setup'],
            ['/dc/shakespeer'],
            ['/dc/strongdc'],
            ['/dc/strongdc_install'],
        ];
    }
}
