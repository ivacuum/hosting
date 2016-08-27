<?php namespace App\Http\Requests\Acp;

class ClientEdit extends ClientCreate
{
    public function rules()
    {
        $rules = parent::rules();

        $rules['name'] .= ",{$this->route('Client')->id}";

        return $rules;
    }
}
