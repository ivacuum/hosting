<?php namespace App\Http\Controllers\Acp;

use App\Domain;
use App\Http\Controllers\Controller;
use App\Http\Requests\Acp\DomainCreate;
use App\Http\Requests\Acp\DomainEdit;
use Illuminate\Http\Request as HttpRequest;
use Log;
use Mail;
use Request;
use Session;

class Domains extends Controller
{
	const DEFAULT_ORDER_BY = 'paid_till';
	
	public function index(HttpRequest $request)
	{
		$filter = $request->get('filter');
		$sort   = $request->get('sort');

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
			case 'orphan':
			
				$domains = Domain::whereOrphan(1)
					->orderBy($sort)
					->get();
				
			break;
			default:
			
				$domains = Domain::whereActive(1)
					->orderBy($sort)
					->get();
		}
		
		$back_url = Request::fullUrl();
		
		return view($this->view, compact('back_url', 'domains', 'filter', 'sort'));
	}
	
	public function addMailbox(Domain $domain, HttpRequest $request)
	{
		extract($request->only('logins', 'send_to'));
		
		$logins = explode(',', $logins);
		$mailboxes = [];
		
		foreach ($logins as $login) {
			$password = str_random(16);
			
			if ('ok' === $domain->addMailbox($login, $password)) {
				$mailboxes[] = [
					'user' => $login,
					'pass' => $password,
				];
			}
		}
		
		$vars = compact('domain', 'mailboxes');
		
		Mail::send('emails.domains.mailboxes', $vars, function($mail) use ($domain, $send_to) {
			$mail->to($send_to)->subject("Доступ к почте {$domain->domain}");
		});
		
		Session::flash('message', "Данные высланы на почту {$send_to}");
		
		return redirect()->action("{$this->class}@show", [$domain->domain, 'tab' => 'mail']);
	}
	
	public function addNsRecord(Domain $domain, HttpRequest $request)
	{
		extract($request->only('type', 'content', 'subdomain'));
		
		return $domain->addNsRecord($type, $content, $subdomain);
	}

	public function create()
	{
		return view($this->view);
	}
	
	public function deleteNsRecord(Domain $domain, HttpRequest $request)
	{
		$id = $request->get('record_id');
		
		return $domain->deleteNsRecord($id);
	}
	
	public function destroy(Domain $domain)
	{
		$domain->delete();
		
		return redirect()->action("{$this->class}@index");
	}
	
	public function edit(Domain $domain)
	{
		return view($this->view, compact('domain'));
	}
	
	public function editNsRecord(Domain $domain, HttpRequest $request)
	{
		extract($request->only('record_id', 'type', 'content', 'subdomain'));
		
		return $domain->editNsRecord($record_id, $type, $content, $subdomain);
	}
	
	public function mailboxes(Domain $domain)
	{
		$mailboxes = $domain->getMailboxes();
		
		return view($this->view, compact('domain', 'mailboxes'));
	}
	
	public function nsRecords(Domain $domain)
	{
		$records = $domain->yandex_user_id ? $domain->getNsRecords() : [];
		
		return view($this->view, compact('domain', 'records'));
	}
	
	public function nsServers(Domain $domain)
	{
		dd($domain->getNsServers());
	}
	
	public function robots(Domain $domain)
	{
		$robots = $domain->getRobotsTxt();

		return view($this->view, compact('robots'));
	}
	
	public function setServerNsRecords(Domain $domain, HttpRequest $request)
	{
		$server = $request->get('server');
		
		$domain->setServerNsRecords($server);
		
		return redirect()->action("{$this->class}@show", [$domain->domain, 'tab' => 'dns']);
	}
	
	public function setYandexNs(Domain $domain)
	{
		$status = $domain->setYandexNs();
		
		$message = 'success' == $status
			? 'Днс Яндекса установлены'
			: 'Не удалось установить днс Яндекса';
		
		Session::flash('message', $message);
		
		return redirect()->action("{$this->class}@show", [$domain->domain, 'tab' => 'dns']);
	}
	
	public function show(Domain $domain, HttpRequest $request)
	{
		switch ($request->get('tab')) {
			case 'dns':   $tab = 'nsRecords'; break;
			case 'mail':  $tab = 'mailboxes'; break;
			case 'whois': $tab = 'whois'; break;
			default:      $tab = 'whois';
		}
		
		return view($this->view, compact('domain', 'tab'));
	}
	
	public function store(DomainCreate $request)
	{
		$domain = Domain::create($request->all());
		
		return redirect()->action("{$this->class}@show", $domain->domain);
	}
	
	public function update(Domain $domain, DomainEdit $request)
	{
		$input = $request->all();
		
		/* Сохранение ранее указанных паролей */
		$passwords = $request->only('cms_pass', 'ftp_pass', 'ssh_pass', 'db_pass');
		
		foreach ($passwords as $key => $value) {
			if (!$value) {
				unset($input[$key]);
			}
		}
		
		$domain->update($input);
		
		$goto = $request->get('goto', '');

		return $goto ? redirect($goto) : redirect()->action("{$this->class}@index");
	}
	
	public function whois(Domain $domain)
	{
		if (!Request::ajax()) {
			abort(404);
		}
		
		$domain->updateWhois();
		
		$whois = nl2br(trim($domain->getWhoisData()));
		
		return view($this->view, compact('whois'));
	}
	
	public function yandexPddStatus(Domain $domain)
	{
		dd($domain->getPddStatus());
	}
}
