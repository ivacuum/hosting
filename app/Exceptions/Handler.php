<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
    ];

    public function report(Exception $e)
    {
        parent::report($e);
    }

    public function render($request, Exception $e)
    {
        if (!config('app.debug', false)) {
            return response()->view("errors.500", ['exception' => $e], 500);
        }

        return parent::render($request, $e);
    }
}
