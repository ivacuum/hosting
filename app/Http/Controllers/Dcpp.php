<?php namespace App\Http\Controllers;

class Dcpp extends Controller
{
    public function index()
    {
        return view($this->view, ['page' => 'index']);
    }

    public function page($page)
    {
        $view = "dcpp.{$page}";

        abort_unless(view()->exists($view), 404);

        $meta_title = \ViewHelper::metaTitle('', $view);

        \Breadcrumbs::push(trans("dcpp.{$page}"));

        return view($view, compact('meta_title', 'page'));
    }

    protected function appendBreadcrumbs(): void
    {
        $this->middleware('breadcrumbs:dcpp.index,dc');
    }
}
