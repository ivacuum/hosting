<?php

namespace App\Http\Requests\Acp;

use App\Http\Requests\Request;

class CountryCreate extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'slug'  => 'required|unique:countries,slug',
        ];
    }
}
