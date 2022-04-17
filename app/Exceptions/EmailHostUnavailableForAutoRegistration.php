<?php namespace App\Exceptions;

class EmailHostUnavailableForAutoRegistration extends \InvalidArgumentException
{
    public static function make()
    {
        return new static('Данная электронная почта недоступна, укажите другую');
    }
}
