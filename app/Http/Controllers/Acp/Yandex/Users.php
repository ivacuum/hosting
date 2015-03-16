<?php namespace App\Http\Controllers\Acp\Yandex;

use App\Domain;
use App\Http\Controllers\Controller;
use App\Http\Requests\Acp\YandexUserCreate;
use App\Http\Requests\Acp\YandexUserEdit;
use App\YandexUser;
use Session;

class Users extends Controller
{
	public function index()
	{
		$users = YandexUser::orderBy('account')->get();
		
		return view($this->view, compact('users'));
	}
	
	public function create()
	{
		$domains = Domain::yandexReady()->get();
		
		return view($this->view, compact('domains'));
	}
	
	public function destroy(YandexUser $user)
	{
		$user->delete();
		
		return redirect()->action("{$this->class}@index");
	}
	
	public function edit(YandexUser $user)
	{
		$domains = Domain::yandexReady($user->id)->get();
		
		return view($this->view, compact('domains', 'user'));
	}
	
	public function show(YandexUser $user)
	{
		return view($this->view, compact('user'));
	}
	
	public function store(YandexUserCreate $request)
	{
		$user = YandexUser::create($request->all());
		
		// Newly specified user domains
		foreach ($request->get('domains', []) as $id => $one) {
			$user_domains[] = $id;
		}

		if (!empty($user_domains)) {
			Domain::whereIn('id', $user_domains)
				->update(['yandex_user_id' => $user->id]);
		}
		
		return redirect()->action("{$this->class}@show", $user);
	}
	
	public function update(YandexUser $user, YandexUserEdit $request)
	{
		$token = $request->get('token');
		
		$user->account = $request->get('account');
		
		if ($token) {
			$user->token = $token;
		}

		$user->save();
		
		// Domains w/out yandex user specified
		foreach ($user->domains as $domain) {
			if (!$request->get("domains.{$domain->id}")) {
				$anon_domains[] = $domain->id;
			}
		}
		
		if (!empty($anon_domains)) {
			Domain::whereIn('id', $anon_domains)
				->update(['yandex_user_id' => 0]);
		}
		
		// Newly specified user domains
		foreach ($request->get('domains', []) as $id => $one) {
			$user_domains[] = $id;
		}

		if (!empty($user_domains)) {
			Domain::whereIn('id', $user_domains)
				->update(['yandex_user_id' => $user->id]);
		}
		
		$goto = $request->get('goto', '');

		return $goto ? redirect($goto) : redirect()->action("{$this->class}@index");
	}
}
