<?php

namespace App;

use App\Observers\EmailObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Ivacuum\Generic\Models\Email as BaseEmail;

#[ObservedBy(EmailObserver::class)]
class Email extends BaseEmail
{
}
