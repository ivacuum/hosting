<?php

namespace App\Livewire\Acp;

use App\ChatMessage;
use App\Domain\ChatMessageStatus;
use App\Livewire\WithGoto;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ChatMessageForm extends Component
{
    use AuthorizesRequests;
    use WithGoto;

    #[Locked]
    public int $id;

    #[Rule('required')]
    public string|null $text = '';

    #[Rule('required')]
    public ChatMessageStatus|string|null $status = ChatMessageStatus::Published;

    public function mount()
    {
        if ($this->id) {
            $chatMessage = ChatMessage::findOrFail($this->id);

            $this->text = $chatMessage->text;
            $this->status = $chatMessage->status;
        }
    }

    public function submit()
    {
        $chatMessage = ChatMessage::findOrFail($this->id);

        $this->authorize('update', $chatMessage);
        $this->validate();
        $this->store($chatMessage);

        return redirect()->to($this->goto ?? to('acp/chat-messages'));
    }

    private function store(ChatMessage $chatMessage)
    {
        $chatMessage->text = $this->text;
        $chatMessage->status = $this->status;
        $chatMessage->save();
    }
}
