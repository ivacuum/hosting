<?php namespace App\Http\Controllers;

use App\ChatMessage;
use App\Http\Resources\ChatMessage as ChatMessageResource;

class AjaxChat extends Controller
{
    public function index()
    {
        return ChatMessageResource::collection(
            ChatMessage::with('user')
                ->where('status', ChatMessage::STATUS_PUBLISHED)
                ->orderBy('id', 'desc')
                ->take(20)
                ->get()
                ->reverse()
                ->values()
        );
    }

    public function store()
    {
        request()->validate(['text' => 'required|max:1000']);

        $chat_message = ChatMessage::create([
            'ip' => request()->ip(),
            'text' => request('text'),
            'status' => ChatMessage::STATUS_PUBLISHED,
            'user_id' => request()->user()->id,
        ]);

        $chat_message->setRelation('user', request()->user());

        $chat = new ChatMessageResource($chat_message);

        broadcast(new \App\Events\ChatMessagePosted($chat->toArray(request())));

        return $chat;
    }
}
