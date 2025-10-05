<?php

namespace App;

use App\Observers\EmailObserver;
use App\Policies\EmailPolicy;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Ivacuum\Generic\Models\Email as BaseEmail;

#[ObservedBy(EmailObserver::class)]
#[UsePolicy(EmailPolicy::class)]
class Email extends BaseEmail {}
