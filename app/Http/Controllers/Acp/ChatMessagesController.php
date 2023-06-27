<?php

namespace App\Http\Controllers\Acp;

use App\Action\Acp\ApplyIndexGoodsAction;
use App\Action\Acp\ResponseToDestroyAction;
use App\Action\Acp\ResponseToEditAction;
use App\Action\Acp\ResponseToShowAction;
use App\ChatMessage;
use App\Domain\ChatMessageStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class ChatMessagesController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(ChatMessage::class);
    }

    public function index(ApplyIndexGoodsAction $applyIndexGoods)
    {
        $sort = $applyIndexGoods->execute(new ChatMessage);

        $status = request('status');
        $userId = request('user_id');

        $models = ChatMessage::query()
            ->with('user')
            ->unless(null === $status, fn (Builder $query) => $query->where('status', $status))
            ->when($userId, fn (Builder $query) => $query->where('user_id', $userId))
            ->orderBy('id', $sort->direction->value)
            ->paginate();

        return view('acp.chat-messages.index', [
            'models' => $models,
            'status' => $status,
            'user_id' => $userId,
        ]);
    }

    public function batch()
    {
        $ids = request('ids', []);
        $action = request('action');

        $models = ChatMessage::find($ids);

        foreach ($models as $model) {
            /** @var ChatMessage $model */
            if ($action === 'delete') {
                $model->delete();
            } elseif ($action === 'hide') {
                $model->status = ChatMessageStatus::Hidden;
                $model->save();
            } elseif ($action === 'publish') {
                $model->status = ChatMessageStatus::Published;
                $model->save();
            }
        }

        return [
            'status' => 'OK',
            'redirect' => path([ChatMessagesController::class, 'index']),
        ];
    }

    public function destroy(ChatMessage $chatMessage, ResponseToDestroyAction $responseToDestroy)
    {
        return $responseToDestroy->execute($chatMessage);
    }

    public function edit(ChatMessage $chatMessage, ResponseToEditAction $responseToEdit)
    {
        return $responseToEdit->execute($chatMessage);
    }

    public function show(ChatMessage $chatMessage, ResponseToShowAction $responseToShow)
    {
        return $responseToShow->execute($chatMessage);
    }
}
