<?php namespace App\Http\Controllers\Acp;

use App\Http\Controllers\Controller;

class Home extends Controller
{
	public function index()
	{
		return view('acp.index');
	}
}
