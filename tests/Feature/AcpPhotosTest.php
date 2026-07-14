<?php

namespace Tests\Feature;

use App\Domain\Life\Factory\PhotoFactory;
use App\Domain\Life\Factory\TagFactory;
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

    public function testRemoveAllTags()
    {
        $photo = PhotoFactory::new()->withTag()->withTrip()->create();
        $secondTag = TagFactory::new()->create();
        $photo->tags()->attach($secondTag);

        $this->delete("acp/photos/{$photo->id}/tags")
            ->assertRedirect();

        $photo->refresh();

        $this->assertCount(0, $photo->tags);
        $this->assertDatabaseHas('tags', ['id' => $secondTag->id]);
    }

    public function testRemoveTag()
    {
        $photo = PhotoFactory::new()->withTag()->withTrip()->create();
        $tag = $photo->tags->first();
        $remainingTag = TagFactory::new()->create();
        $photo->tags()->attach($remainingTag);

        $this->delete("acp/photos/{$photo->id}/tags/{$tag->id}")
            ->assertRedirect();

        $photo->refresh();

        $this->assertFalse($photo->tags->contains($tag));
        $this->assertTrue($photo->tags->contains($remainingTag));
        $this->assertDatabaseHas('tags', ['id' => $tag->id]);
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
