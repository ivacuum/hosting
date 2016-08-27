<?php namespace App\Http\Requests\Acp;

use App\Http\Requests\Request;

class DomainCreate extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'domain'         => 'required|min:3|unique:domains,domain',
            'active'         => 'boolean',
            'domain_control' => 'boolean',
        ];
    }
}
