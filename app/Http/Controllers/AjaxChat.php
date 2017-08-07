<?php namespace App\Http\Controllers;

use App\ChatMessage;

class AjaxChat extends Controller
{
    public function index()
    {
        $messages = ChatMessage::with('user')
            ->where('status', ChatMessage::STATUS_PUBLISHED)
            ->orderBy('id', 'desc')
            ->take(20)
            ->get()
            ->reverse()
            ->map(function ($item) {
                /* @var \App\ChatMessage $item */
                return [
                    'id' => $item->id,
                    'date' => $item->created_at->toDateString(),
                    'time' => $item->created_at->toTimeString(),
                    'html' => $item->html,
                    'author' => $item->user->publicName(),
                ];
            })
            ->values();

        return compact('messages');
    }

    public function store()
    {
        $this->validate($this->request, [
            'mail' => 'empty',
            'text' => 'required|max:1000',
        ]);

        $text = trim($this->request->input('text'));
        $user = \Auth::user();

        $chat_message = ChatMessage::create([
            'ip' => $this->request->ip(),
            'text' => $text,
            'status' => ChatMessage::STATUS_PUBLISHED,
            'user_id' => $user->id,
        ]);

        $message = [
            'id' => $chat_message->id,
            'date' => $chat_message->created_at->toDateString(),
            'time' => $chat_message->created_at->toTimeString(),
            'html' => $chat_message->html,
            'author' => $user->publicName(),
        ];

        broadcast(new \App\Events\ChatMessagePosted($message));

        return compact('message');
    }
}
