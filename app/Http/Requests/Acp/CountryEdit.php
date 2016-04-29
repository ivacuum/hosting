<?php

namespace App\Http\Requests\Acp;

class CountryEdit extends CountryCreate
{
    public function rules()
    {
        $rules = parent::rules();

        $rules['slug'] .= ",{$this->route('Country')->id}";

        return $rules;
    }
}
