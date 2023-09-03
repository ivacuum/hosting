<?php

namespace Tests\Feature;

use App\Factory\TagFactory;
use App\Livewire\Acp\TagForm;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpTagsTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testCreate()
    {
        $this->get('acp/tags/create')
            ->assertOk()
            ->assertSeeLivewire(TagForm::class);
    }

    public function testEdit()
    {
        $tag = TagFactory::new()->create();

        $this->get("acp/tags/{$tag->id}/edit")
            ->assertOk()
            ->assertSeeLivewire(TagForm::class);
    }

    public function testIndex()
    {
        TagFactory::new()->create();

        $this->get('acp/tags')
            ->assertOk();
    }

    public function testShow()
    {
        $tag = TagFactory::new()->create();

        $this->get("acp/tags/{$tag->id}")
            ->assertOk();
    }

    public function testStore()
    {
        $tag = TagFactory::new()->make();

        \Livewire::test(TagForm::class)
            ->set('titleRu', $tag->title_ru)
            ->set('titleEn', $tag->title_en)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/tags');

        $this->get('acp/tags')
            ->assertSee($tag->title);
    }

    public function testUpdate()
    {
        $tag = TagFactory::new()->create();

        \Livewire::test(TagForm::class, ['id' => $tag->id])
            ->set('titleRu', '🇷🇺')
            ->set('titleEn', '🇬🇧')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/tags');

        $tag->refresh();

        $this->assertSame('🇷🇺', $tag->title_ru);
        $this->assertSame('🇬🇧', $tag->title_en);
    }
}
