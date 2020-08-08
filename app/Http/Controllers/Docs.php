<?php namespace App\Http\Controllers;

class Docs extends Controller
{
    public function index()
    {
        return view('docs.index');
    }

    public function page($page)
    {
        $view = "docs.{$page}";

        abort_unless(view()->exists($view), 404);

        return view($view, ['page' => $page]);
    }
}
