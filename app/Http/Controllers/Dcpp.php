<?php namespace App\Http\Controllers;

use App\Utilities\ViewHelper;

class Dcpp extends Controller
{
    public function __construct()
    {
        $this->middleware('breadcrumbs:dcpp.index,dc');
    }

    public function index()
    {
        \Breadcrumbs::pop();

        return view('dcpp.index', ['page' => 'index']);
    }

    public function page(string $page, ViewHelper $viewHelper)
    {
        $view = "dcpp.{$page}";

        abort_unless(view()->exists($view), 404);

        \Breadcrumbs::push(trans("dcpp.{$page}"));

        return view($view, [
            'page' => $page,
            'metaTitle' => $viewHelper->metaTitle($view),
            'metaDescription' => $viewHelper->metaDescription($view),
        ]);
    }
}
