<?php namespace App\Http\Requests\Acp;

class TripEdit extends TripCreate
{
    public function rules()
    {
        $rules = parent::rules();

        $rules['title_ru'] = 'required';
        $rules['title_en'] = 'required';
        $rules['slug'] .= ",{$this->route('Trip')->id}";

        return $rules;
    }
}
