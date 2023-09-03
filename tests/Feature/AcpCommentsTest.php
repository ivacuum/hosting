<?php

namespace Tests\Feature;

use App\Domain\CommentStatus;
use App\Factory\CommentFactory;
use App\Livewire\Acp\CommentForm;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpCommentsTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testEdit()
    {
        $comment = CommentFactory::new()->withNews()->create();

        $this->get("acp/comments/{$comment->id}/edit")
            ->assertOk()
            ->assertSeeLivewire(CommentForm::class);
    }

    public function testIndex()
    {
        CommentFactory::new()->withNews()->create();

        $this->get('acp/comments')
            ->assertOk();
    }

    public function testShow()
    {
        $comment = CommentFactory::new()->withNews()->create();

        $this->get("acp/comments/{$comment->id}")
            ->assertOk();
    }

    public function testUpdate()
    {
        $comment = CommentFactory::new()->create();

        \Livewire::test(CommentForm::class, ['id' => $comment->id])
            ->set('html', 'Markdown html! 🌚️')
            ->set('status', CommentStatus::Hidden->value)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/comments');

        $comment->refresh();

        $this->assertSame(CommentStatus::Hidden, $comment->status);
        $this->assertSame('Markdown html! 🌚️', $comment->html);
    }
}
