<?php namespace App\Http\Requests\Acp;

class FileEdit extends FileCreate
{
    public function rules()
    {
        $rules = parent::rules();

        $rules['slug'] .= ",{$this->route('File')->slug}";

        return $rules;
    }
}
