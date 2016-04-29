<?php

namespace App\Http\Requests\Acp;

use App\Http\Requests\Request;

class CityCreate extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'country_id' => 'required|integer|min:1',
            'title'      => 'required',
            'slug'       => 'required|unique:cities,slug',
        ];
    }
}
