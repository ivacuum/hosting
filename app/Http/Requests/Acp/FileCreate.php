<?php namespace App\Http\Requests\Acp;

use App\Http\Requests\Request;

class FileCreate extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:files,slug',
        ];
    }
}
