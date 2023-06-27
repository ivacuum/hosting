<?php

namespace App\Http\Livewire\Acp;

use App\ChatMessage;
use App\Http\Livewire\WithGoto;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class ChatMessageForm extends Component
{
    use AuthorizesRequests;
    use WithGoto;

    public ChatMessage $chatMessage;

    public function rules()
    {
        return [
            'chatMessage.text' => 'required',
            'chatMessage.status' => 'required',
        ];
    }

    public function submit()
    {
        $this->authorize('update', $this->chatMessage);
        $this->validate();
        $this->chatMessage->save();

        return redirect()->to($this->goto ?? to('acp/chat-messages'));
    }
}
