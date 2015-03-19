<?php namespace App\Http\Requests\Acp;

class UserEdit extends UserCreate
{
	public function rules()
	{
		$rules = parent::rules();
		
		$rules['email'] .= ",{$this->route('User')->id}";
		$rules['password'] = 'min:6';
		
		return $rules;
	}
}
