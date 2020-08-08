<?php namespace App\Http\Controllers;

class NewsBcController extends Controller
{
    public function __invoke()
    {
        return redirect(path([NewsController::class, 'index']), 301);
    }
}
