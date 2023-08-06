<?php

namespace Tests\Livewire;

use App\Factory\UserFactory;
use App\Http\Livewire\Chat;
use App\Notifications\ChatMessagePublishedAdminNotification;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ChatTest extends TestCase
{
    use DatabaseTransactions;

    public function testPost()
    {
        $text = 'Chat message to post';
        $user = UserFactory::new()->create();

        \Notification::fake();

        \Livewire::actingAs($user)
            ->test(Chat::class)
            ->set('text', $text)
            ->call('post');

        $this->assertCount(1, $user->chatMessages);
        $this->assertSame($text, $user->chatMessages[0]->text);

        \Notification::assertCount(1);
        \Notification::assertSentTimes(ChatMessagePublishedAdminNotification::class, 1);
    }
}
