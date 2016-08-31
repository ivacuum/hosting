<?php namespace App\Mail;

use App\Domain;
use Illuminate\Mail\Mailable;

class DomainMailboxes extends Mailable
{
    public $domain;
    public $mailboxes;

    public function __construct(Domain $domain, array $mailboxes)
    {
        $this->domain = $domain;
        $this->mailboxes = $mailboxes;
    }

    public function build()
    {
        return $this->view('emails.domains.mailboxes')
            ->subject("Доступ к почте {$this->domain->domain}");
    }
}
