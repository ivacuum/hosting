<?php namespace App\Http\Requests\Acp;

class PageEdit extends PageCreate
{
	public function rules()
	{
		$rules = parent::rules();

		$rules['url'] .= ",{$this->route('Page')->id}";
		
		return $rules;
	}
}
