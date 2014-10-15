<?php namespace Acp;

use App;
use Domain;
use Input;
use Redirect;
use Request;
use Validator;
use View;

class Domains extends \BaseController
{
	public function index()
	{
		return View::make('acp.domains.index')
			->withDomains(Domain::whereActive(1)->orderBy('paid_till')->get());
	}
	
	public function create()
	{
		return View::make('acp.domains.create');
	}
	
	public function destroy(Domain $domain)
	{
		$domain->delete();
		
		return Redirect::route('acp.domains.index');
	}
	
	public function edit(Domain $domain)
	{
		return View::make('acp.domains.edit')
			->with(compact('domain'));
	}
	
	public function show(Domain $domain)
	{
		return View::make('acp.domains.show')
			->with(compact('domain'));
	}
	
	public function store()
	{
		$validator = Validator::make(Input::all(), Domain::rules());
		
		if ($validator->fails()) {
			return Redirect::route('acp.domains.create')
				->withErrors($validator)
				->withInput(Input::all());
		}
		
		$domain = Domain::create(Input::all());
		
		Session::flash('message', 'Domain created');
		
		return Redirect::route('acp.domains.show', $domain->domain);
	}
	
	public function update(Domain $domain)
	{
		$validator = Validator::make(Input::all(), Domain::rules($domain->id));
		
		if ($validator->fails()) {
			return Redirect::route('acp.domains.edit', $domain->domain)
				->withErrors($validator)
				->withInput(Input::all());
		}

		$domain->update(Input::all());

		return Redirect::route('acp.domains.index');
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
