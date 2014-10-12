<?php

class Domains extends BaseController
{
	public function __construct()
	{
		$this->beforeFilter('auth');
	}
	
	public function index()
	{
		return View::make('domains.index')
			->withDomains(Domain::whereActive(1)->orderBy('paid_till')->get());
	}
	
	public function create()
	{
		return View::make('domains.create');
	}
	
	public function destroy(Domain $domain)
	{
		$domain->delete();
		
		return Redirect::route('domains.index');
	}
	
	public function edit(Domain $domain)
	{
		return View::make('domains.edit')
			->with(compact('domain'));
	}
	
	public function show(Domain $domain)
	{
		return View::make('domains.show')
			->with(compact('domain'));
	}
	
	public function store()
	{
		$validator = Validator::make(Input::all(), Domain::rules());
		
		if ($validator->fails()) {
			return Redirect::route('domains.create')
				->withErrors($validator)
				->withInput(Input::all());
		}
		
		$domain = Domain::create(Input::all());
		
		Session::flash('message', 'Domain created');
		
		return Redirect::route('domains.show', $domain->domain);
	}
	
	public function update(Domain $domain)
	{
		$validator = Validator::make(Input::all(), Domain::rules($domain->id));
		
		if ($validator->fails()) {
			return Redirect::route('domains.edit', $domain->domain)
				->withErrors($validator)
				->withInput(Input::all());
		}

		$domain->update(Input::all());

		return Redirect::route('domains.index');
	}
	
	public function whois(Domain $domain)
	{
		if (!Request::ajax()) {
			App::abort(404);
		}
		
		$domain->updateWhois();
		
		return nl2br(trim($domain->getWhoisData()));
	}
}
