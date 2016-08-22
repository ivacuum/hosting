<?php namespace App\Http\Controllers\Acp;

use App\Domain;
use App\Http\Requests\Acp\DomainCreate;
use App\Http\Requests\Acp\DomainEdit;
use Mail;
use Session;

class Domains extends Controller
{
	const DEFAULT_ORDER_BY = 'domain';

	public function index()
	{
        if ($this->user->id !== 1) {
            abort(404);
        }

		$filter = $this->request->input('filter');
		$sort   = $this->request->input('sort');
		$q      = $this->request->input('q');

		if (!in_array($sort, ['domain', 'registered_at', 'paid_till'])) {
			$sort = self::DEFAULT_ORDER_BY;
		}

		switch ($filter) {
			case 'external':

				$domains = Domain::whereActive(1)
					->whereDomainControl(0);

			break;
			case 'inactive':

				$domains = Domain::whereActive(0);

			break;
			case 'no-ns':

				$domains = Domain::whereActive(1)
					->whereNs('');

			break;
			case 'no-server':

				$domains = Domain::whereActive(1)
					->whereIpv4('');

			break;
			case 'orphan':

				$domains = Domain::whereOrphan(1);

			break;
			case 'trashed':

				$domains = Domain::onlyTrashed();

			break;
			default:

				$domains = Domain::whereActive(1);
		}

		if ($q) {
			$domains = $domains->where('domain', 'LIKE', "%{$q}%");
		}

		$domains = $domains->orderBy($sort)
			->paginate()
			->appends(compact('sort', 'filter', 'q'));

		$back_url = $this->request->fullUrl();

		return view($this->view, compact('back_url', 'domains', 'filter', 'sort', 'q'));
	}

	public function addMailbox(Domain $domain)
	{
		extract($this->request->only('logins', 'send_to'));

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

		Mail::send('emails.domains.mailboxes', $vars, function ($mail) use ($domain, $send_to) {
			$mail->to($send_to)->subject("Доступ к почте {$domain->domain}");
		});

		Session::flash('message', "Данные высланы на почту {$send_to}");

		return redirect()->action("{$this->class}@mailboxes", $domain);
	}

	public function addNsRecord(Domain $domain)
	{
		$input = $this->request->only('content', 'subdomain', 'priority', 'port', 'weight');

		return $domain->addNsRecord($this->request->input('type'), $input);
	}

	public function batch()
	{
		extract($this->request->only('action', 'ids'));

		$params = [];

		switch ($action) {
			case 'activate':

				Domain::whereIn('id', $ids)->update(['active' => 1]);

			break;
			case 'deactivate':

				Domain::whereIn('id', $ids)->update(['active' => 0]);

			break;
			case 'delete':

				Domain::destroy($ids);

			break;
			case 'force_delete':

				$params['filter'] = 'trashed';

				Domain::whereIn('id', $ids)->onlyTrashed()->forceDelete();

			break;
			case 'restore':

				$params['filter'] = 'trashed';

				Domain::whereIn('id', $ids)->onlyTrashed()->restore();

			break;
		}

		return ['redirect' => action("{$this->class}@index", $params)];
	}

	public function create()
	{
		return view($this->view);
	}

	public function deleteNsRecord(Domain $domain)
	{
		$id = $this->request->input('record_id');

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

	public function editNsRecord(Domain $domain)
	{
		extract($this->request->only('record_id', 'type'));
		$input = $this->request->only('content', 'subdomain', 'priority', 'port', 'weight', 'retry', 'refresh', 'expire', 'ttl');

		return $domain->editNsRecord($record_id, $type, $input);
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

		return view($this->view, compact('domain', 'robots'));
	}

	public function setServerNsRecords(Domain $domain)
	{
		$server = $this->request->input('server');

		$domain->setServerNsRecords($server);

		return redirect()->action("{$this->class}@nsRecords", $domain);
	}

	public function setYandexNs(Domain $domain)
	{
		$status = $domain->setYandexNs();

		$message = 'success' == $status
			? 'Днс Яндекса установлены'
			: 'Не удалось установить днс Яндекса';

		Session::flash('message', $message);

		return redirect()->action("{$this->class}@show", $domain);
	}

	public function show(Domain $domain)
	{
        if ($this->user->id !== 1) {
            abort(404);
        }

		return view($this->view, compact('domain'));
	}

	public function store(DomainCreate $request)
	{
		$domain = Domain::create($request->all());

		return redirect()->action("{$this->class}@show", $domain);
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

		$goto = $request->input('goto', '');

		return $goto ? redirect($goto) : redirect()->action("{$this->class}@index");
	}

	public function whois(Domain $domain)
	{
		$domain->updateWhois();

		$whois = nl2br(trim($domain->getWhoisData()));

		return view($this->view, compact('domain', 'whois'));
	}

	public function yandexPddStatus(Domain $domain)
	{
		dd($domain->getPddStatus());
	}
}
