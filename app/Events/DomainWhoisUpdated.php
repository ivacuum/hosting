<?php namespace App\Events;

use App\Domain;
use Illuminate\Queue\SerializesModels;

class DomainWhoisUpdated extends Event
{
    use SerializesModels;

    public $data;
    public $domain;

    public function __construct(Domain $domain, $data)
    {
        $this->data   = $data;
        $this->domain = $domain;
    }
}
