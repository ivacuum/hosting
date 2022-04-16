<?php namespace Tests\Feature;

use App\Factory\TripFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->get('/')
            ->assertOk()
            ->assertHasCustomTitle();
    }

    public function testIndexWithTrips()
    {
        TripFactory::new()->metaImage()->create();

        $this->get('/')
            ->assertOk();
    }

    public function testAbout()
    {
        $this->get('about')
            ->assertOk();
    }

    public function testCv()
    {
        $this->get('cv')
            ->assertOk()
            ->assertHasCustomTitle();
    }
}
