<?php namespace Acp;

class Home extends \BaseController
{
	public function index()
	{
		return \View::make('acp.index');
	}
}
