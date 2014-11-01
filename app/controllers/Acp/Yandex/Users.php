<?php namespace Acp\Yandex;

use BaseController;
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
		return View::make($this->view);
	}
	
	public function destroy(YandexUser $user)
	{
		$user->delete();
		
		return Redirect::action("{$this->class}@index");
	}
	
	public function edit(YandexUser $user)
	{
		return View::make($this->view, compact('user'));
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
		
		return Redirect::action("{$this->class}@show", $user->id);
	}
	
	public function update(YandexUser $user)
	{
		$validator = Validator::make(Input::all(), YandexUser::rules($user->id));
		
		if ($validator->fails()) {
			return Redirect::action("{$this->class}@edit", $user->id)
				->withErrors($validator)
				->withInput(Input::all());
		}
		
		$user->update(Input::all());
		
		return Redirect::action("{$this->class}@index");
	}
}
