<?php namespace App\Exceptions;

class EmailHostUnavailableForAutoRegistration extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('Данная электронная почта недоступна, укажите другую');
    }
}
