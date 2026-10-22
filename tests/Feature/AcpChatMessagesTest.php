<?php

namespace Tests\Feature;

use App\Factory\ChatMessageFactory;
use App\Livewire\Acp\ChatMessageForm;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpChatMessagesTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testEdit(): void
    {
        $chatMessage = ChatMessageFactory::new()->create();

        $this->get("acp/chat-messages/{$chatMessage->id}/edit")
            ->assertOk()
            ->assertSeeLivewire(ChatMessageForm::class);
    }

    public function testIndex(): void
    {
        ChatMessageFactory::new()->create();

        $this->get('acp/chat-messages')
            ->assertOk();
    }

    public function testShow(): void
    {
        $chatMessage = ChatMessageFactory::new()->create();

        $this->get("acp/chat-messages/{$chatMessage->id}")
            ->assertOk();
    }

    public function testUpdate(): void
    {
        $chatMessage = ChatMessageFactory::new()->create();

        \Livewire::test(ChatMessageForm::class, ['id' => $chatMessage->id])
            ->set('text', 'Markdown text! 🌚️')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/chat-messages');

        $chatMessage->refresh();

        $this->assertSame('Markdown text! 🌚️', $chatMessage->text);
        $this->assertNotEmpty($chatMessage->html);
    }
}
