<?php namespace Tests\Feature;

use App\Events\ChatMessageCreated;
use App\Events\ChatMessagePosted;
use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ChatTest extends TestCase
{
    use DatabaseTransactions;

    public function testChatPostAsUser()
    {
        $this->be($user = UserFactory::new()->create());

        $this->expectsEvents([
            ChatMessagePosted::class,
            ChatMessageCreated::class,
        ]);

        $this->postJson('ajax/chat', ['text' => 'Chat message to post'])
            ->assertStatus(201)
            ->assertJsonStructure(['data']);
    }
}
