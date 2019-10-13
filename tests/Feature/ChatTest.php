<?php namespace Tests\Feature;

use App\Events\ChatMessageCreated;
use App\Events\ChatMessagePosted;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ChatTest extends TestCase
{
    use DatabaseTransactions;

    public function testChatPostAsUser()
    {
        /** @var User $user */
        $this->be($user = factory(User::class)->create());

        $this->expectsEvents([
            ChatMessagePosted::class,
            ChatMessageCreated::class,
        ]);

        $this->postJson('ajax/chat', ['text' => 'Chat message to post'])
            ->assertStatus(201)
            ->assertJsonStructure(['data']);
    }
}
