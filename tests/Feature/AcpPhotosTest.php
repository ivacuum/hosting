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

    public function testCreate(): void
    {
        $this->get('acp/photos/create')
            ->assertOk()
            ->assertSeeLivewire(PhotoUploadForm::class);
    }

    public function testDestroy(): void
    {
        \Storage::fake('photos');

        $tag = TagFactory::new()->create();
        $photo = PhotoFactory::new()->withTags($tag)->withTrip()->create();

        $this->delete("acp/photos/{$photo->id}")
            ->assertOk();

        $this->assertDatabaseMissing('photos', ['id' => $photo->id]);
        $this->assertDatabaseMissing('taggable', [
            'rel_type' => $photo->getMorphClass(),
            'rel_id' => $photo->id,
        ]);
        $this->assertDatabaseHas('tags', ['id' => $tag->id]);
    }

    public function testEdit(): void
    {
        $photo = PhotoFactory::new()->withTrip()->create();

        $this->get("acp/photos/{$photo->id}/edit")
            ->assertOk();
    }

    public function testIndex(): void
    {
        PhotoFactory::new()->withTrip()->create();

        $this->get('acp/photos')
            ->assertOk();
    }

    public function testRemoveAllTags(): void
    {
        $secondTag = TagFactory::new()->create();
        $photo = PhotoFactory::new()
            ->withTags(TagFactory::new(), $secondTag)
            ->withTrip()
            ->create();

        $this->delete("acp/photos/{$photo->id}/tags")
            ->assertRedirect();

        $photo->refresh();

        $this->assertCount(0, $photo->tags);
        $this->assertDatabaseHas('tags', ['id' => $secondTag->id]);
    }

    public function testRemoveTag(): void
    {
        $tag = TagFactory::new()->create();
        $remainingTag = TagFactory::new()->create();
        $photo = PhotoFactory::new()->withTags($tag, $remainingTag)->withTrip()->create();

        $this->delete("acp/photos/{$photo->id}/tags/{$tag->id}")
            ->assertRedirect();

        $photo->refresh();

        $this->assertFalse($photo->tags->contains($tag));
        $this->assertTrue($photo->tags->contains($remainingTag));
        $this->assertDatabaseHas('tags', ['id' => $tag->id]);
    }

    public function testShow(): void
    {
        $photo = PhotoFactory::new()->withTrip()->create();

        $this->get("acp/photos/{$photo->id}")
            ->assertOk();
    }

    public function testUpdate(): void
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
