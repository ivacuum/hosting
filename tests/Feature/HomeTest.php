<?php namespace Tests\Feature;

use App\Trip;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->get(action('Home@index'))
            ->assertStatus(200);
    }

    public function testIndexWithTrips()
    {
        factory(Trip::class)->states('city', 'meta_image')->create();

        $this->get(action('Home@index'))
            ->assertStatus(200);
    }

    public function testAbout()
    {
        $this->get(action('Home@about'))
            ->assertStatus(200);
    }

    public function testCv()
    {
        $this->get(action('Home@cv'))
            ->assertStatus(200);
    }
}
