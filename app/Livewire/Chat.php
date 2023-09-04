<?php

namespace App\Livewire;

use App\ChatMessage;
use App\Domain\ChatMessageStatus;
use App\Domain\LivewireEvent;
use App\Events\ChatMessagePublished;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Chat extends Component
{
    /** @var \Illuminate\Database\Eloquent\Collection|array<string, ChatMessage[]> */
    public $rows;

    #[Rule(['required', 'string', 'min:1'])]
    public string $text = '';

    public function boot()
    {
        $this->dispatch(LivewireEvent::ScrollChatDown->name);
    }

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
            ->values()
            ->groupBy(fn (ChatMessage $chatMessage) => $chatMessage->created_at->toDateString());

        return view('livewire.chat');
    }
}
