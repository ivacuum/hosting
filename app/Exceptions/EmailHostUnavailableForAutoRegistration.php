<?php

namespace App\Exceptions;

class EmailHostUnavailableForAutoRegistration extends \InvalidArgumentException
{
    public static function make(): self
    {
        return new self('Данная электронная почта недоступна, укажите другую');
    }
}
