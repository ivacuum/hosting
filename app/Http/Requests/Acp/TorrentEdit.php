<?php namespace App\Http\Requests\Acp;

class TorrentEdit extends CountryCreate
{
    public function rules()
    {
        $rules = parent::rules();

        $rules['rto_id'] .= ",{$this->route('Torrent')->rto_id}";

        return $rules;
    }
}
