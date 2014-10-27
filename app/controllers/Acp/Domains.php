<?php namespace Acp;

use App;
use BaseController;
use Domain;
use Input;
use Redirect;
use Request;
use Validator;
use View;

class Domains extends BaseController
{
	const DEFAULT_ORDER_BY = 'paid_till';
	
	public function index()
	{
		$filter = Input::get('filter');
		$sort   = Input::get('sort');

		if (!in_array($sort, ['domain', 'registered_at', 'paid_till'])) {
			$sort = self::DEFAULT_ORDER_BY;
		}
		
		switch ($filter) {
			case 'external':
			
				$domains = Domain::whereActive(1)
					->whereDomainControl(0)
					->orderBy($sort)
					->get();
				
			break;
			case 'inactive':
			
				$domains = Domain::whereActive(0)
					->orderBy($sort)
					->get();
				
			break;
			case 'no-ns':
			
				$domains = Domain::whereActive(1)
					->whereNs('')
					->orderBy($sort)
					->get();
			
			break;
			case 'no-server':
			
				$domains = Domain::whereActive(1)
					->whereIpv4('')
					->orderBy($sort)
					->get();
				
			break;
			default:
			
				$domains = Domain::whereActive(1)
					->orderBy($sort)
					->get();
		}
		
		return View::make('acp.domains.index', compact('domains', 'filter', 'sort'));
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
		return View::make('acp.domains.edit', compact('domain'));
	}
	}
	
	public function show(Domain $domain)
	{
		return View::make('acp.domains.show', compact('domain'));
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
		
		$input = Input::all();
		
		/* Сохранение ранее указанных паролей */
		$passwords = Input::only('cms_pass', 'ftp_pass', 'ssh_pass', 'db_pass');
		
		foreach ($passwords as $key => $value) {
			if (!$value) {
				unset($input[$key]);
			}
		}
		
		$domain->update($input);
		
		$goto = Input::get('goto', '');

		return $goto ? Redirect::to($goto) : Redirect::route('acp.domains.index');
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
