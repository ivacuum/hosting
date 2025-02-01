<?php

namespace App\Domain\Telegram\Action;

use App\LinkRequest;
use Ramsey\Uuid\Uuid;

class GenerateLinkRequestAction
{
    public function execute(int $userId): LinkRequest
    {
        if ($linkRequest = LinkRequest::query()->find($userId)) {
            return $linkRequest;
        }

        $linkRequest = new LinkRequest;
        $linkRequest->token = Uuid::uuid4()->toString();
        $linkRequest->user_id = $userId;
        $linkRequest->save();

        return $linkRequest;
    }
}
