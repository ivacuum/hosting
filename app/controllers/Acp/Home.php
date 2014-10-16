<?php namespace Acp;

use BaseController;
use View;

class Home extends BaseController
{
	public function index()
	{
		return View::make('acp.index');
	}
}
