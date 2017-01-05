<?php namespace App\Http\Requests\Acp;

class TorrentEdit extends TorrentCreate
{
    public function rules()
    {
        $rules = parent::rules();

        $rules['rto_id'] .= ",{$this->route('Torrent')->rto_id},rto_id";

        return $rules;
    }
}
