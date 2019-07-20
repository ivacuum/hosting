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
        $chatMessage = new ChatMessage([
            'ip' => $request->ip(),
            'text' => $request->input('text'),
            'status' => ChatMessage::STATUS_PUBLISHED,
            'user_id' => $request->user()->id,
        ]);

        $chatMessage->setRelation('user', $request->user());
        $chatMessage->save();

        $chatResource = new ChatMessageResource($chatMessage);

        broadcast(new \App\Events\ChatMessagePosted($chatResource->toArray($request)));

        return $chatResource;
    }
}
