<?php namespace App\Http\Controllers;

use App\Page;

class Home extends Controller
{
	public function index()
	{
		return view('index');
	}
	
	public function cv()
	{
		return view('cv');
	}

	public function staticPage()
	{
		$breadcrumbs = Page::find($this->getPageId())->ancestorsAndSelf()->get();
		$page = $breadcrumbs[sizeof($breadcrumbs) - 1];
		
		return view('static', compact('breadcrumbs', 'page'));
	}
}
