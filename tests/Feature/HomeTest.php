<?php namespace Tests\Feature;

use App\Trip;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->get('/')
            ->assertStatus(200);
    }

    public function testIndexWithTrips()
    {
        factory(Trip::class)->states('city', 'meta_image')->create();

        $this->get('/')
            ->assertStatus(200);
    }

    public function testAbout()
    {
        $this->get('about')
            ->assertStatus(200);
    }

    public function testCv()
    {
        $this->get('cv')
            ->assertStatus(200);
    }
}
