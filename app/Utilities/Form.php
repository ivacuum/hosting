<?php namespace App\Utilities;

class Form
{
    protected $model;

    public function model($model)
    {
        $this->model = $model;

        return $this;
    }

    public function text(...$parameters)
    {
        return (new Form\Text(...$parameters))->model($this->model);
    }
}
