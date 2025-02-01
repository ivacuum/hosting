<?php

namespace App\Http\Controllers;

use App\Domain\Config;
use App\Domain\Telegram\Action\GenerateLinkRequestAction;
use App\User;
use Illuminate\Container\Attributes\CurrentUser;

class MyLinkTelegramController
{
    public function __invoke(
        #[CurrentUser] User $user,
        GenerateLinkRequestAction $generateLinkRequest,
    ) {
        $linkRequest = $generateLinkRequest->execute($user->id);

        return redirect('https://t.me/' . Config::TelegramBotUsername->get() . "?start={$linkRequest->token}");
    }
}
