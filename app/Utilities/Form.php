<?php

namespace App\Utilities;

class Form
{
    protected $model;

    public function model($model)
    {
        $this->model = $model;

        return $this;
    }

    public function checkbox(...$parameters): Form\Checkbox
    {
        return new Form\Checkbox(...$parameters)->model($this->model);
    }

    public function radio(...$parameters): Form\Radio
    {
        return new Form\Radio(...$parameters)->model($this->model);
    }

    public function select(...$parameters): Form\Select
    {
        return new Form\Select(...$parameters)->model($this->model);
    }

    public function text(...$parameters): Form\Text
    {
        return new Form\Text(...$parameters)->model($this->model);
    }

    public function textarea(...$parameters): Form\Textarea
    {
        return new Form\Textarea(...$parameters)->model($this->model);
    }
}
