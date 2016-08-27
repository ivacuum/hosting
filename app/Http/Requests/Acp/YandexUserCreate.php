<?php namespace App\Http\Requests\Acp;

use App\Http\Requests\Request;

class YandexUserCreate extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'account' => 'required|unique:yandex_users,account',
            'token'   => 'required',
        ];
    }
}
