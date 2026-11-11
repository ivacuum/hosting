<?php

namespace Tests\Livewire;

use App\Factory\UserFactory;
use App\Livewire\Chat;
use App\Notifications\ChatMessagePublishedAdminNotification;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ChatTest extends TestCase
{
    use DatabaseTransactions;

    public function testPost(): void
    {
        $text = 'Tom & Jerry <b>';
        $user = UserFactory::new()->create();

        \Notification::fake();

        \Livewire::actingAs($user)
            ->test(Chat::class)
            ->set('text', $text)
            ->call('post');

        $this->assertCount(1, $user->chatMessages);
        $this->assertSame($text, $user->chatMessages->first()->text);
        $this->assertSame("<p>Tom &amp; Jerry &lt;b&gt;</p>\n", $user->chatMessages->first()->html);

        \Notification::assertCount(1);
        \Notification::assertSentTimes(ChatMessagePublishedAdminNotification::class, 1);
    }
}
