<?php

namespace App\Observers;

use App\Domain\Locale;
use App\Models\Email;

class EmailObserver
{
    public function creating(Email $email): void
    {
        if (!$email->locale) {
            $email->locale = Locale::forNotification(\App::getLocale());
        }
    }
}
