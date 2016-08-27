<?php namespace App\Http\Requests\Acp;

use App\Http\Requests\Request;

class PageCreate extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'active' => 'boolean',
            'title'  => 'required',
            'url'    => 'required|unique:pages,url',
        ];
    }
}
