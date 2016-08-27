<?php namespace App\Http\Requests\Acp;

class YandexUserEdit extends YandexUserCreate
{
    public function rules()
    {
        $rules = parent::rules();

        $rules['account'] .= ",{$this->route('YandexUser')->id}";
        $rules['token'] = '';

        return $rules;
    }
}
