<?php

namespace Tests\Livewire;

use App\Domain\Life\Factory\PhotoFactory;
use App\Domain\Life\Factory\TripFactory;
use App\Domain\Life\Livewire\PhotoShow;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Livewire\Livewire;
use Tests\TestCase;

class PhotoShowTest extends TestCase
{
    use DatabaseTransactions;

    public function testAdjacentPhotosUseLivewireNavigationAndArePreloaded(): void
    {
        $trip = TripFactory::new()->create();
        $next = PhotoFactory::new()->withSlug('test/next.jpg')->withTrip($trip)->create();
        $photo = PhotoFactory::new()->withSlug('test/current.jpg')->withTrip($trip)->create();
        $prev = PhotoFactory::new()->withSlug('test/previous.jpg')->withTrip($trip)->create();

        Livewire::test(PhotoShow::class, [
            'photo' => $photo,
            'next' => $next,
            'prev' => $prev,
            'tripId' => $trip->id,
        ])
            ->assertSee('wire:navigate', false)
            ->assertSeeHtml('<img hidden src="' . $next->originalUrl() . '" alt="">')
            ->assertSeeHtml('<img hidden src="' . $prev->originalUrl() . '" alt="">')
            ->assertSee("trip_id={$trip->id}", false);
    }

    public function testPhotoPageRendersLivewireComponent(): void
    {
        $photo = PhotoFactory::new()->withTrip()->create();

        $this->get("photos/{$photo->id}")
            ->assertOk()
            ->assertSeeLivewire(PhotoShow::class);
    }
}
