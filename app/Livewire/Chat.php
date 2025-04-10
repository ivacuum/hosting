<?php

namespace App\Livewire;

use App\ChatMessage;
use App\Domain\ChatMessageStatus;
use App\Domain\LivewireEvent;
use App\Events\ChatMessagePublished;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;

/**
 * @property Collection<string, ChatMessage> $rows
 */
class Chat extends Component
{
    #[Validate(['required', 'string', 'min:1'])]
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

    #[Computed]
    public function rows(): Collection
    {
        return ChatMessage::query()
            ->where('status', ChatMessageStatus::Published)
            ->orderByDesc('id')
            ->take(20)
            ->get()
            ->reverse()
            ->values();
    }
}
