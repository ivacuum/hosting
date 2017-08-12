<?php namespace App\Http\Controllers;

class My extends Controller
{
    public function index()
    {
        return view($this->view);
    }
}
