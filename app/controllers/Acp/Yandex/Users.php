<?php namespace Acp\Yandex;

use BaseController;
use Domain;
use Input;
use Redirect;
use Session;
use Validator;
use View;
use YandexUser;

class Users extends BaseController
{
	public function index()
	{
		return View::make($this->view)
			->withUsers(YandexUser::get());
	}
	
	public function create()
	{
		$domains = Domain::yandexReady()->get();
		
		return View::make($this->view, compact('domains'));
	}
	
	public function destroy(YandexUser $user)
	{
		$user->delete();
		
		return Redirect::action("{$this->class}@index");
	}
	
	public function edit(YandexUser $user)
	{
		$domains = Domain::yandexReady($user->id)->get();
		
		return View::make($this->view, compact('domains', 'user'));
	}
	
	public function show(YandexUser $user)
	{
		return View::make($this->view, compact('user'));
	}
	
	public function store()
	{
		$validator = Validator::make(Input::all(), YandexUser::rules());
		
		if ($validator->fails()) {
			return Redirect::action("{$this->class}@create")
				->withErrors($validator)
				->withInput(Input::all());
		}
		
		$user = YandexUser::create(Input::all());
		
		// Newly specified user domains
		foreach (Input::get('domains', []) as $id => $one) {
			$user_domains[] = $id;
		}

		if ($user_domains) {
			Domain::whereIn('id', $user_domains)
				->update(['yandex_user_id' => $user->id]);
		}
		
		return Redirect::action("{$this->class}@show", $user->id);
	}
	
	public function update(YandexUser $user)
	{
		$token = Input::get('token');
		
		$validator = Validator::make(
			Input::all(),
			YandexUser::rules($user->id, $token)
		);
		
		if ($validator->fails()) {
			return Redirect::action("{$this->class}@edit", $user->id)
				->withErrors($validator)
				->withInput(Input::all());
		}
		
		$user->account = Input::get('account');
		
		if ($token) {
			$user->token = $token;
		}

		$user->save();
		
		$anon_domains = $user_domains = [];
		
		// Domains w/out yandex user specified
		foreach ($user->domains as $domain) {
			if (!Input::get("domains.{$domain->id}")) {
				$anon_domains[] = $domain->id;
			}
		}
		
		if ($anon_domains) {
			Domain::whereIn('id', $anon_domains)
				->update(['yandex_user_id' => 0]);
		}
		
		// Newly specified user domains
		foreach (Input::get('domains', []) as $id => $one) {
			$user_domains[] = $id;
		}

		if ($user_domains) {
			Domain::whereIn('id', $user_domains)
				->update(['yandex_user_id' => $user->id]);
		}
		
		$goto = Input::get('goto', '');

		return $goto ? Redirect::to($goto) : Redirect::action("{$this->class}@index");
	}
}
