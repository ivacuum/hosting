<?php

namespace App\Http\Requests\Acp;

use App\Http\Requests\Request;

class ServerCreate extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'host'  => 'required',
        ];
    }
}
