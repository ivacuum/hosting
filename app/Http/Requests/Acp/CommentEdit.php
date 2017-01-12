<?php namespace App\Http\Requests\Acp;

use App\Http\Requests\Request;

class CommentEdit extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'html' => 'required',
        ];
    }
}
