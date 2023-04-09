<?php namespace App\Observers;

use App\Email;

class EmailObserver
{
    public function creating(Email $email)
    {
        if (!$email->locale) {
            $email->locale = \App::getLocale();
        }
    }
}
