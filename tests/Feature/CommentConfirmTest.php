<?php

namespace Tests\Feature;

use App\Factory\CommentFactory;
use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CommentConfirmTest extends TestCase
{
    use DatabaseTransactions;

    public function testAlreadyPublished(): void
    {
        $comment = CommentFactory::new()
            ->withNews()
            ->create();

        $this->actingAs($comment->user)
            ->get("comments/{$comment->id}/confirm")
            ->assertRedirect($comment->rel->www())
            ->assertSessionHas('message', 'Комментарий уже активирован.');
    }

    public function testForbiddenForStrangers(): void
    {
        $stranger = UserFactory::new()->create();

        $comment = CommentFactory::new()
            ->pending()
            ->withNews()
            ->create();

        $this->actingAs($stranger)
            ->get("comments/{$comment->id}/confirm")
            ->assertForbidden();
    }

    public function testHidden(): void
    {
        $comment = CommentFactory::new()
            ->hidden()
            ->withNews()
            ->create();

        $this->actingAs($comment->user)
            ->get("comments/{$comment->id}/confirm")
            ->assertRedirect($comment->rel->www())
            ->assertSessionHas('message', 'Комментарий уже активирован.');
    }

    public function testPending(): void
    {
        $comment = CommentFactory::new()
            ->pending()
            ->withNews()
            ->create();

        $this->actingAs($comment->user)
            ->get("comments/{$comment->id}/confirm")
            ->assertRedirect($comment->rel->www($comment->anchor()));

        $comment->refresh();

        $this->assertTrue($comment->status->isPublished());
    }
}
