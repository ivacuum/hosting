<?php namespace Tests;

use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;

abstract class TestCase extends \Illuminate\Foundation\Testing\TestCase
{
    use CreatesApplication;

    protected $old_exception_handler;

    protected function setUp()
    {
        parent::setUp();

        $this->disableExceptionHandling();
    }

    protected function disableExceptionHandling()
    {
        $this->old_exception_handler = $this->app->make(ExceptionHandler::class);

        $this->app->instance(ExceptionHandler::class, new class extends Handler {
            public function __construct() {}
            public function report(\Exception $e) {}
            public function render($request, \Exception $e) {
                throw $e;
            }
        });
    }

    protected function withExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, $this->old_exception_handler);

        return $this;
    }
}
