<?php

namespace App\Http\Requests\Acp;

use App\Http\Requests\Request;

class ClientCreate extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'  => 'required|unique:clients,name',
            'email' => 'email',
        ];
    }
}
