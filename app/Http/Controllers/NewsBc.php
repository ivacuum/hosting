<?php namespace App\Http\Controllers;

class NewsBc
{
    public function __invoke()
    {
        return redirect(path([NewsController::class, 'index']), 301);
    }
}
