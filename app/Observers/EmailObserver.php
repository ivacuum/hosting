<?php

namespace App\Observers;

use App\Domain\Locale;
use App\Email;

class EmailObserver
{
    public function creating(Email $email)
    {
        if (!$email->locale) {
            $email->locale = Locale::from(\App::getLocale());
        }
    }
}
