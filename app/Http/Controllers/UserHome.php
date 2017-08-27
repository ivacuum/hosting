<?php namespace App\Http\Controllers;

class UserHome extends Controller
{
    public function index($login)
    {
        return redirect("@{$login}/travel");
    }
}
