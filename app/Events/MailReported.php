<?php

namespace App\Events;

use App\Email;
use Illuminate\Queue\SerializesModels;

class MailReported
{
    use SerializesModels;

    public function __construct(public Email $email) {}
}
