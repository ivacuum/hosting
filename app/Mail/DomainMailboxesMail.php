<?php

namespace App\Mail;

use App\Domain;
use Illuminate\Mail\Mailable;

class DomainMailboxesMail extends Mailable
{
    public function __construct(public Domain $domain, public array $mailboxes)
    {
    }

    public function build()
    {
        return $this->view('emails.domains.mailboxes')
            ->subject("Доступ к почте {$this->domain->domain}");
    }
}
