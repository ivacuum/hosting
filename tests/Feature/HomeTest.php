<?php

namespace Tests\Feature;

use App\Domain\Life\Factory\TripFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use DatabaseTransactions;

    public function testAbout(): void
    {
        $this->get('about')
            ->assertOk();
    }

    public function testCv(): void
    {
        $this->get('cv')
            ->assertOk()
            ->assertHasCustomTitle();
    }

    public function testHead(): void
    {
        $this->head('/')
            ->assertOk();
    }

    public function testIndex(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertHeader('Link')
            ->assertHasCustomTitle();
    }

    public function testIndexWithTrips(): void
    {
        TripFactory::new()->metaImage()->create();

        $this->get('/')
            ->assertOk();
    }

    public function testRu(): void
    {
        $this->get('ru')
            ->assertNotFound();
    }
}
