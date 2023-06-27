<?php

namespace App\Exceptions;

use App\Http\Controllers\Auth\SignIn;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    public function register()
    {
        $this->reportable(app(SkipDatabaseOffline::class));

        if (app()->isProduction()) {
            $this->reportable(app(TelegramValidationException::class));
            $this->reportable(app(TelegramAnyException::class));
        }

        $this->renderable(function (HttpException $e) {
            if ($e->getPrevious() instanceof TokenMismatchException) {
                return back()
                    ->withInput()
                    ->with('message', __('Пожалуйста, повторите отправку формы. За два часа мы вас подзабыли'));
            }
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson()
            ? response()->json(['message' => $exception->getMessage()], 401)
            : redirect()->guest(path([SignIn::class, 'index']))
                ->with('message', __('auth.signin_to_view_page'));
    }
}
