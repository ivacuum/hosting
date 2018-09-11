<?php namespace App\Http\Controllers;

use App\ChatMessage;
use App\Http\Requests\ChatStore;
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

    public function store(ChatStore $request)
    {
        $chat_message = new ChatMessage([
            'ip' => $request->ip(),
            'text' => $request->input('text'),
            'status' => ChatMessage::STATUS_PUBLISHED,
            'user_id' => $request->user()->id,
        ]);

        $chat_message->setRelation('user', $request->user());
        $chat_message->save();

        $chat_resource = new ChatMessageResource($chat_message);

        broadcast(new \App\Events\ChatMessagePosted($chat_resource->toArray($request)));

        return $chat_resource;
    }
}
