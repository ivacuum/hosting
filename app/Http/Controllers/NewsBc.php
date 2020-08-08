<?php namespace App\Http\Controllers;

class NewsBc extends Controller
{
    public function __invoke()
    {
        return redirect(path([NewsController::class, 'index']), 301);
    }
}
