<?php namespace App\Http\Requests\Acp;

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
            'city_id'   => 'required|integer|min:1',
            'artist_id' => 'required|integer|min:1',
            'title_ru'  => 'required',
            'title_en'  => 'required',
            'slug'      => 'required|unique:gigs,slug',
            'date'      => 'required|date',
        ];
    }
}
