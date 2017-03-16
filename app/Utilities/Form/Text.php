<?php namespace App\Utilities\Form;

class Text extends Base
{
    public $name;
    public $required = false;
    public $type = 'text';

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function required($value = true)
    {
        $this->required = $value === true ? true : false;

        return $this;
    }

    public function html()
    {
        return view('acp.tpl.input', $this->buildData());
    }
}
