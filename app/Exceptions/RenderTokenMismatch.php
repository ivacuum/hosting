<?php

namespace App\Exceptions;

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
            ->with('message', __('Пожалуйста, повторите отправку формы. За два часа мы вас подзабыли'));
    }
}
