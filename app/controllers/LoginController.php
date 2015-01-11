<?php

class LoginController extends BaseController
{
	public function __construct()
	{
		parent::__construct();
		
		$this->beforeFilter('auth', ['only' => 'getLogout']);
		$this->beforeFilter('guest', ['only' => 'getLogin', 'postLogin']);
	}

	public function getLogin()
	{
		return View::make('login');
	}
	
	public function getLogout()
	{
		Auth::logout();
	
		return Redirect::to('/');
	}
	
	public function postLogin()
	{
		$auth = [
			'email'    => Input::get('email'),
			'password' => Input::get('password'),
			'active'   => 1,
		];
	
		$foreign_computer = Input::get('foreign', false);
	
		if (Auth::attempt($auth, !$foreign_computer)) {
			return Redirect::intended('/');
		}
	
		return Redirect::action('LoginController@getLogin')
			->with('message', 'Email/password combination is incorrect')
			->withInput();
	}
}
