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

	public function life($page)
	{
		$tpl = 'life.' . str_replace('.', '_', $page);
		
		if (!view()->exists($tpl)) {
			abort(404);
		}
		
		return view($tpl, compact('page'));
	}

	public function staticPage()
	{
		$breadcrumbs = Page::find($this->getPageId())->ancestorsAndSelf()->get();
		$page = $breadcrumbs[sizeof($breadcrumbs) - 1];
		
		return view('static', compact('breadcrumbs', 'page'));
	}
}
