<?php namespace App\Events;

use App\Domain;
use Illuminate\Queue\SerializesModels;

class DomainWhoisUpdated extends Event
{
    use SerializesModels;

    public function __construct(public Domain $domain, public $data)
    {
    }
}
