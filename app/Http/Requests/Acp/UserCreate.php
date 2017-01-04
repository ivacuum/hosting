<?php namespace App\Http\Requests\Acp;

use App\Http\Requests\Request;

class UserCreate extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'    => 'required|email|unique:users,email',
            'password' => 'required_without:random_password|min:6',
            'status'   => 'boolean',
        ];
    }
}
