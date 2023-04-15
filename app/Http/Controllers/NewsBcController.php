<?php namespace App\Http\Controllers;

class NewsBcController
{
    public function __invoke()
    {
        return redirect(path([NewsController::class, 'index']), 301);
    }
}
