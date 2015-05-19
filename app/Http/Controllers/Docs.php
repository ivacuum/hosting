<?php namespace App\Http\Controllers;

class Docs extends Controller
{
	public function index()
	{
		return view($this->view);
	}
	
	public function page($page)
	{
		$view = "docs.{$page}";
		
		if (!view()->exists($view)) {
			abort(404);
		}
		
		return view($view, compact('page'));
	}
}
