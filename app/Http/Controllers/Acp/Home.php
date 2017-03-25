<?php namespace App\Http\Controllers\Acp;

use Ivacuum\Generic\Controllers\Acp\BaseController;

class Home extends BaseController
{
    public function index()
    {
        return view('acp.index');
    }
}
