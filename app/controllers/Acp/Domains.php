<?php namespace Acp;

use App;
use BaseController;
use Domain;
use Input;
use Log;
use Mail;
use Redirect;
use Request;
use Session;
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
		
		$back_url = Request::fullUrl();
		
		return View::make($this->view, compact('back_url', 'domains', 'filter', 'sort'));
	}
	
	public function addMailbox(Domain $domain)
	{
		extract(Input::only('logins', 'forward', 'send_to'));
		
		$logins = explode(',', $logins);
		$mailboxes = [];
		
		foreach ($logins as $login) {
			if ($domain->doesMailboxExist($login)) {
				throw new \Exception("Ящик {$login} уже существует");
			}
		}
		
		foreach ($logins as $login) {
			$password = str_random(16);
			
			$domain->addMailbox($login, $password);
			
			if ($forward) {
				$domain->setForwardMail($login, $forward);
			}
			
			$mailboxes[] = [
				'user' => $login,
				'pass' => $password,
			];
		}
		
		$vars = compact('domain', 'forward', 'mailboxes');
		
		Mail::send('emails.domains.mailboxes', $vars, function($mail) use ($domain, $send_to) {
			$mail->to($send_to)->subject("Доступ к почте {$domain->domain}");
		});
		
		Session::flash('message', "Данные высланы на почту {$send_to}");
		
		return Redirect::action("{$this->class}@show", [$domain->domain, 'tab' => 'mail']);
	}
	
	public function addNsRecord(Domain $domain)
	{
		extract(Input::only('type', 'content', 'subdomain'));
		
		return $domain->addNsRecord($type, $content, $subdomain);
	}

	public function create()
	{
		return View::make($this->view);
	}
	
	public function deleteNsRecord(Domain $domain)
	{
		$id = Input::get('record_id');
		
		return $domain->deleteNsRecord($id);
	}
	
	public function destroy(Domain $domain)
	{
		$domain->delete();
		
		return Redirect::action("{$this->class}@index");
	}
	
	public function edit(Domain $domain)
	{
		return View::make($this->view, compact('domain'));
	}
	
	public function editNsRecord(Domain $domain)
	{
		extract(Input::only('record_id', 'type', 'content', 'subdomain'));
		
		return $domain->editNsRecord($record_id, $type, $content, $subdomain);
	}
	
	public function mailboxes(Domain $domain)
	{
		return View::make($this->view, compact('domain'));
	}
	
	public function nsRecords(Domain $domain)
	{
		$records = $domain->getNsRecords()->domains->domain->response->record;
		
		return View::make($this->view, compact('domain', 'records'));
	}
	
	public function nsServers(Domain $domain)
	{
		dd($domain->getNsServers());
	}
	
	public function setYandexNs(Domain $domain)
	{
		$status = $domain->setYandexNs();
		
		$message = 'success' == $status
			? 'Днс Яндекса установлены'
			: 'Не удалось установить днс Яндекса';
		
		Session::flash('message', $message);
		
		return Redirect::action("{$this->class}@show", $domain->domain);
	}
	
	public function show(Domain $domain)
	{
		switch (Input::get('tab')) {
			case 'dns':   $tab = 'nsRecords'; break;
			case 'mail':  $tab = 'mailboxes'; break;
			case 'whois': $tab = 'whois'; break;
			default:      $tab = 'whois';
		}
		
		return View::make($this->view, compact('domain', 'tab'));
	}
	
	public function store()
	{
		$validator = Validator::make(Input::all(), Domain::rules());
		
		if ($validator->fails()) {
			return Redirect::action("{$this->class}@create")
				->withErrors($validator)
				->withInput(Input::all());
		}
		
		$domain = Domain::create(Input::all());
		
		return Redirect::action("{$this->class}@show", $domain->domain);
	}
	
	public function update(Domain $domain)
	{
		$validator = Validator::make(Input::all(), Domain::rules($domain->id));
		
		if ($validator->fails()) {
			return Redirect::action("{$this->class}@edit", $domain->domain)
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

		return $goto ? Redirect::to($goto) : Redirect::action("{$this->class}@index");
	}
	
	public function whois(Domain $domain)
	{
		if (!Request::ajax()) {
			App::abort(404);
		}
		
		$domain->updateWhois();
		
		$whois = nl2br(trim($domain->getWhoisData()));
		
		return View::make($this->view, compact('whois'));
	}
}
