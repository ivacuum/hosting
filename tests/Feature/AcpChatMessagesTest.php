<?php namespace Tests\Feature;

use App\Factory\ChatMessageFactory;
use App\Factory\UserFactory;
use App\Http\Livewire\Acp\ChatMessageForm;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpChatMessagesTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->be(UserFactory::new()->admin()->make());
    }

    public function testEdit()
    {
        $chatMessage = ChatMessageFactory::new()->create();

        $this->get("acp/chat-messages/{$chatMessage->id}/edit")
            ->assertOk()
            ->assertSeeLivewire(ChatMessageForm::class);
    }

    public function testIndex()
    {
        ChatMessageFactory::new()->create();

        $this->get('acp/chat-messages')
            ->assertOk();
    }

    public function testShow()
    {
        $chatMessage = ChatMessageFactory::new()->create();

        $this->get("acp/chat-messages/{$chatMessage->id}")
            ->assertOk();
    }

    public function testUpdate()
    {
        $chatMessage = ChatMessageFactory::new()->create();

        \Livewire::test(ChatMessageForm::class, ['chatMessage' => $chatMessage])
            ->set('chatMessage.text', 'Markdown text! 🌚️')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/chat-messages');

        $chatMessage->refresh();

        $this->assertSame('Markdown text! 🌚️', $chatMessage->text);
        $this->assertNotEmpty($chatMessage->html);
    }
}
