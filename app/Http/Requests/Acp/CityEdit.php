<?php

namespace App\Http\Requests\Acp;

class CityEdit extends CityCreate
{
    public function rules()
    {
        $rules = parent::rules();

        $rules['slug'] .= ",{$this->route('City')->id}";

        return $rules;
    }
}
