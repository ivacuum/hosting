<?php namespace App\Http\Requests\Acp;

class ArtistEdit extends ArtistCreate
{
    public function rules()
    {
        $rules = parent::rules();

        $rules['slug'] .= ",{$this->route('Artist')->id}";

        return $rules;
    }
}
