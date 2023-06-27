<?php

namespace App;

use Illuminate\Database\Eloquent\MassPrunable;
use Ivacuum\Generic\Models\Notification as BaseNotification;

class Notification extends BaseNotification
{
    use MassPrunable;

    public function prunable()
    {
        return self::query()
            ->where('created_at', '<', now()->subDays(21));
    }
}
