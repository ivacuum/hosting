<?php

namespace App\Http\Livewire;

use App\ChatMessage;
use App\Domain\ChatMessageStatus;
use App\Events\ChatMessagePublished;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Livewire\Component;

class Chat extends Component
{
    /** @var \Illuminate\Database\Eloquent\Collection|array<string, ChatMessage[]> */
    public $rows;
    public string $text = '';

    public function post(Request $request)
    {
        if ($request->user() === null) {
            throw new AuthorizationException;
        }

        $this->validate();

        $chatMessage = new ChatMessage;
        $chatMessage->ip = $request->ip();
        $chatMessage->text = $this->text;
        $chatMessage->status = ChatMessageStatus::Published;
        $chatMessage->user_id = $request->user()->id;
        $chatMessage->save();

        event(new ChatMessagePublished($chatMessage));

        $this->reset();
    }

    public function render()
    {
        $this->rows = ChatMessage::query()
            ->with('user')
            ->where('status', ChatMessageStatus::Published)
            ->orderByDesc('id')
            ->take(20)
            ->get()
            ->reverse()
            ->values();

        return view('livewire.chat');
    }

    public function rules()
    {
        return [
            'text' => ['required', 'string', 'min:1'],
        ];
    }
}
