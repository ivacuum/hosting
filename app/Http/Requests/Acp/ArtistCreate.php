<?php namespace App\Http\Requests\Acp;

use App\Http\Requests\Request;

class ArtistCreate extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'slug'  => 'required|unique:artists,slug',
        ];
    }
}
