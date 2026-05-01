<?php

namespace App\Livewire\Acp;

use App\ChatMessage;
use App\Domain\ChatMessageStatus;
use App\Livewire\WithGoto;
use Livewire\Attributes\Authorize;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ChatMessageForm extends Component
{
    use WithGoto;

    public ChatMessage $chatMessage;

    #[Locked]
    public int $id;

    #[Validate('required')]
    public string|null $text = '';

    #[Validate('required')]
    public ChatMessageStatus $status = ChatMessageStatus::Published;

    public function mount()
    {
        if ($this->id) {
            $this->chatMessage = ChatMessage::query()->findOrFail($this->id);

            $this->text = $this->chatMessage->text;
            $this->status = $this->chatMessage->status;
        }
    }

    #[Authorize('update', 'chatMessage')]
    public function submit()
    {
        $this->validate();
        $this->store();

        return redirect()->to($this->goto ?? to('acp/chat-messages'));
    }

    private function store()
    {
        $this->chatMessage->text = $this->text;
        $this->chatMessage->status = $this->status;
        $this->chatMessage->save();
    }
}
