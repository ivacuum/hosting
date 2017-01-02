<?php namespace App\Http\Controllers;

class Errors extends Controller
{
    public function unauthorized()
    {
        return view('errors.401');
    }

    public function forbidden()
    {
        return view('errors.403');
    }

    public function notFound()
    {
        return view('errors.404');
    }

    public function internalError()
    {
        return view('errors.500');
    }

    public function serviceUnavailable()
    {
        return view('errors.503');
    }
}
