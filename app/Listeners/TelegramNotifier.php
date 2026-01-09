<?php

namespace App\Listeners;

use App\Services\Telegram;
use Illuminate\Http\Request;

/**
 * Заготовка для уведомлений в Телеграм
 */
class TelegramNotifier
{
    public function __construct(protected Request $request, protected Telegram $telegram) {}
}
