<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as BaseTrimmer;

class TrimStrings extends BaseTrimmer
{
    protected $except = [
        'new_password',
        'password',
        'password_confirmation',
    ];
}
