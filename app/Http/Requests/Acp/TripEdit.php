<?php

namespace App\Http\Requests\Acp;

class TripEdit extends TripCreate
{
    public function rules()
    {
        $rules = parent::rules();

        $rules['slug'] .= ",{$this->route('Trip')->id}";

        return $rules;
    }
}
