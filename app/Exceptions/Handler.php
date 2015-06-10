<?php namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
	protected $dontReport = [
		\Symfony\Component\HttpKernel\Exception\HttpException::class,
	];

	public function report(Exception $e)
	{
		return parent::report($e);
	}

	public function render($request, Exception $e)
	{
		return parent::render($request, $e);
	}
}
