<?php

namespace App\Http\Requests\Acp;

use App\Http\Requests\Request;

class GigCreate extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'city_id' => 'required|integer|min:1',
            'title'   => 'required',
            'slug'    => 'required|unique:gigs,slug',
            'tpl'     => 'required',
            'date'    => 'required|date',
        ];
    }
}
