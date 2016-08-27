<?php namespace App\Http\Requests\Acp;

class GigEdit extends GigCreate
{
    public function rules()
    {
        $rules = parent::rules();

        $rules['slug'] .= ",{$this->route('Gig')->id}";

        return $rules;
    }
}
