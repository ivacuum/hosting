<?php namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Ivacuum\Generic\Utilities\ExceptionHelper;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        AuthenticationException::class,
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        TokenMismatchException::class,
        ValidationException::class,
    ];

    public function report(Exception $e)
    {
        if ($e instanceof ValidationException && false === config('app.debug', false)) {
            ExceptionHelper::logValidation($e);
        }

        if ($this->shouldReport($e) && false === config('app.debug', false)) {
            $this->reportTelegram($e);
        }

        parent::report($e);
    }

    public function render($request, Exception $e)
    {
        if ($e instanceof TokenMismatchException) {
            return back()->withInput()
                ->with('message', 'Пожалуйста, повторите отправку формы. За два часа мы вас подзабыли');
        }

        return parent::render($request, $e);
    }

    protected function convertExceptionToResponse(Exception $e)
    {
        if (config('app.debug', false)) {
            return parent::convertExceptionToResponse($e);
        }

        return response()->view('errors.500', ['exception' => $e], 500);
    }

    protected function reportTelegram(Exception $e)
    {
        ExceptionHelper::log($e);

        if ($previous = $e->getPrevious()) {
            $this->reportTelegram($previous);
        }
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(action('Auth@login'))
            ->with('message', trans('auth.signin_to_view_page'));
    }
}
