<?php

class Domains extends BaseController
{
	/**
	* index()
	* create()
	* store()
	* show($id)
	* edit($id)
	* update($id)
	* destroy($id)
	*/
	public function index()
	{
		return View::make('domains.index')
			->withDomains(Domain::whereActive(1)->orderBy('paid_till')->get());
	}
	
	public function show($id)
	{
		return View::make('domains.show')
			->withDomain(Domain::find($id));
	}
}
