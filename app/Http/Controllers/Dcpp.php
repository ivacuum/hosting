<?php namespace App\Http\Controllers;

class Dcpp extends Controller
{
    public function index()
    {
        $page = 'index';

        return view($this->view, compact('page'));
    }

    public function page($page)
    {
        $view = "dcpp.{$page}";

        abort_unless(view()->exists($view), 404);

        \Breadcrumbs::push(trans("dcpp.{$page}"));

        return view($view, compact('page'));
    }

    protected function appendBreadcrumbs()
    {
        $this->middleware('breadcrumbs:dcpp.index,dc');
    }
}
