<?php namespace App\Http\Requests\Acp;

class DomainEdit extends DomainCreate
{
    public function rules()
    {
        $rules = parent::rules();

        $rules['domain'] .= ",{$this->route('Domain')->id}";

        return $rules;
    }
}
