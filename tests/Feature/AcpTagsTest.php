<?php namespace Tests\Feature;

use App\Factory\TagFactory;
use App\Factory\UserFactory;
use App\Http\Livewire\Acp\TagForm;
use App\Tag;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpTagsTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->be(UserFactory::new()->admin()->make());
    }

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

        \Livewire::test(TagForm::class, ['tag' => new Tag])
            ->set('tag.title_ru', $tag->title_ru)
            ->set('tag.title_en', $tag->title_en)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/tags');

        $this->get('acp/tags')
            ->assertSee($tag->title);
    }

    public function testUpdate()
    {
        $tag = TagFactory::new()->create();

        \Livewire::test(TagForm::class, ['tag' => $tag])
            ->set('tag.title_ru', '🇷🇺')
            ->set('tag.title_en', '🇬🇧')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/tags');

        $tag->refresh();

        $this->assertSame('🇷🇺', $tag->title_ru);
        $this->assertSame('🇬🇧', $tag->title_en);
    }
}
