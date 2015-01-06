<?php

class HomeController extends BaseController
{
	public function index()
	{
		return View::make('index');
	}
	
	public function life($page)
	{
		$tpl = 'pages.' . str_replace('.', '_', $page);
		
		if (!View::exists($tpl)) {
			App::abort(404);
		}
		
		return View::make($tpl);
	}
}
