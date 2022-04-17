<?php namespace App\Http\Controllers\Acp;

use Ivacuum\Generic\Controllers\Acp\BaseController;

class HomeController extends BaseController
{
    public function __invoke()
    {
        \Breadcrumbs::pop();

        return view('acp.index');
    }
}
