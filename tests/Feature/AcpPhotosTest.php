<?php

namespace Tests\Feature;

use App\Factory\PhotoFactory;
use App\Livewire\Acp\PhotoEditForm;
use App\Livewire\Acp\PhotoUploadForm;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpPhotosTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testCreate()
    {
        $this->get('acp/photos/create')
            ->assertOk()
            ->assertSeeLivewire(PhotoUploadForm::class);
    }

    public function testEdit()
    {
        $photo = PhotoFactory::new()->withTrip()->create();

        $this->get("acp/photos/{$photo->id}/edit")
            ->assertOk();
    }

    public function testIndex()
    {
        PhotoFactory::new()->withTrip()->create();

        $this->get('acp/photos')
            ->assertOk();
    }

    public function testShow()
    {
        $photo = PhotoFactory::new()->withTrip()->create();

        $this->get("acp/photos/{$photo->id}")
            ->assertOk();
    }

    public function testUpdate()
    {
        $photo = PhotoFactory::new()->withTag()->withTrip()->create();

        \Livewire::test(PhotoEditForm::class, ['photo' => $photo])
            ->set('tags', [])
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/photos');

        $photo->refresh();

        $this->assertCount(0, $photo->tags);
    }
}
