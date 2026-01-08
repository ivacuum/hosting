<?php

namespace App\Exceptions;

use App\Domain\SessionKey;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RenderTokenMismatch
{
    public function __invoke(HttpException $e)
    {
        if (!$e->getPrevious() instanceof TokenMismatchException) {
            return null;
        }

        return back()
            ->withInput()
            ->with(SessionKey::FlashMessage->value, __('Пожалуйста, повторите отправку формы. За два часа мы вас подзабыли'));
    }
}
