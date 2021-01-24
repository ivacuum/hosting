<?php namespace App\Events;

use App\Domain;
use Illuminate\Queue\SerializesModels;

class DomainWhoisUpdated extends Event
{
    use SerializesModels;

    public $data;

    public function __construct(public Domain $domain, $data)
    {
        $this->data = $data;
    }
}
