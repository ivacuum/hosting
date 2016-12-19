<?php namespace App\Http\Requests\Acp;

use App\Http\Requests\Request;

class TorrentCreate extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'rto_id'    => 'required|unique:torrents,rto_id',
            'title'     => 'required',
            'text'      => 'required',
            'info_hash' => 'required',
        ];
    }
}
