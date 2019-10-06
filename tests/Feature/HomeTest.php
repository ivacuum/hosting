<?php namespace Tests\Feature;

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\Home;
use App\Trip;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->get(action([Home::class, 'index']))
            ->assertStatus(200);
    }

    public function testIndexWithTrips()
    {
        factory(Trip::class)->states('city', 'meta_image')->create();

        $this->get(action([Home::class, 'index']))
            ->assertStatus(200);
    }

    public function testAbout()
    {
        $this->get(action('\\' . AboutController::class))
            ->assertStatus(200);
    }

    public function testCv()
    {
        $this->get(action('\\' . CvController::class))
            ->assertStatus(200);
    }
}
