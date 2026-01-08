<?php

namespace App\Domain;

enum SessionKey: string
{
    case FlashMessage = 'message';
}
