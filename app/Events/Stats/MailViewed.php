<?php

namespace App\Events\Stats;

class MailViewed
{
    public $table = 'emails';

    public function __construct(public $id) {}
}
