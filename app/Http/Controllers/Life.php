<?php

namespace App\Http\Controllers;

class Life extends Controller
{
    public function index()
    {
        return view($this->view);
    }

    public function page($page)
    {
        $tpl = 'life.' . str_replace('.', '_', $page);

        if (!view()->exists($tpl)) {
            abort(404);
        }

        return view($tpl, compact('page'));
    }
}
