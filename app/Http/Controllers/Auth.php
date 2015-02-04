<?php namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class Auth extends Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->middleware('auth', ['only' => 'logout']);
		$this->middleware('guest', ['except' => 'logout']);
	}

	public function login()
	{
		return view('login');
	}
	
	public function loginPost(Guard $auth, Request $request)
	{
		$this->validate($request, [
			'mail'     => 'empty',
			'email'    => 'required',
			'password' => 'required',
		]);
		
		$credentials = [
			'email'    => $request->get('email'),
			'password' => $request->get('password'),
			'active'   => 1,
		];
	
		if ($auth->attempt($credentials, !$request->has('foreign'))) {
			return redirect()->intended('/');
		}
	
		return redirect('/login')
			->withMessage('Электронная почта или пароль неверны')
			->withInput();
	}

	public function logout(Guard $auth)
	{
		$auth->logout();
	
		return redirect('/');
	}
	
	public function register()
	{
		return view('register');
	}
	
	public function registerPost(Guard $auth, Request $request)
	{
		$this->validate($request, [
			'mail'     => 'empty',
			'email'    => 'required|email|max:255|unique:users,email',
			'password' => 'required|min:6',
		]);
		
		$data = $request->all();
		
		$user = User::create([
			'email'    => $data['email'],
			'password' => $data['password'],
			'active'   => 1,
		]);
		
		// Mail::send('emails.users.activation', compact('user'), function($mail) use ($user) {
		// 	$mail->to($user->email)->subject("Активация учетной записи");
		// });
		
		$auth->login($user);
		
		return redirect('/');
	}
}
