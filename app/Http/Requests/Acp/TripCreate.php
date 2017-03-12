<?php namespace App\Http\Requests\Acp;

use App\Http\Requests\Request;

class TripCreate extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'city_id'    => 'required|integer|min:1',
            'slug'       => 'required|unique:countries,slug',
            'date_start' => 'required|date',
            'date_end'   => 'required|date',
        ];
    }
}
