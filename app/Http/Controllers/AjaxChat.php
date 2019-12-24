<?php namespace App\Http\Controllers;

use App\ChatMessage;
use App\Http\Requests\ChatStoreRequest;
use App\Http\Resources\ChatMessage as ChatMessageResource;

class AjaxChat extends Controller
{
    public function index()
    {
        return ChatMessageResource::collection(
            ChatMessage::with('user')
                ->where('status', ChatMessage::STATUS_PUBLISHED)
                ->orderByDesc('id')
                ->take(20)
                ->get()
                ->reverse()
                ->values()
        );
    }

    public function store(ChatStoreRequest $request)
    {
        $chatMessage = new ChatMessage;
        $chatMessage->ip = $request->ip();
        $chatMessage->text = $request->text();
        $chatMessage->status = ChatMessage::STATUS_PUBLISHED;
        $chatMessage->user_id = $request->userModel()->id;
        $chatMessage->setRelation('user', $request->userModel());
        $chatMessage->save();

        $chatResource = new ChatMessageResource($chatMessage);

        broadcast(new \App\Events\ChatMessagePosted($chatResource->toArray($request)));

        return $chatResource;
    }
}
