<?php

namespace App\Exceptions;

use App\Domain\SessionKey;
use Illuminate\Http\Exceptions\OriginMismatchException;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RenderTokenMismatch
{
    public function __invoke(HttpException $e)
    {
        $previous = $e->getPrevious();

        if (!$previous instanceof TokenMismatchException && !$previous instanceof OriginMismatchException) {
            return null;
        }

        return back()
            ->withInput()
            ->with(SessionKey::FlashMessage->value, __('Пожалуйста, повторите отправку формы. За два часа мы вас подзабыли'));
    }
}
