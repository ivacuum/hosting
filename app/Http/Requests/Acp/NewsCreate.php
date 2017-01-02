<?php namespace App\Http\Requests\Acp;

use App\Http\Requests\Request;

class NewsCreate extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'site_id' => 'required|integer|min:1',
            'title'   => 'required',
            'slug'    => 'required',
            'html'    => 'required',
        ];
    }
}
