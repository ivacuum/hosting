<?php namespace App\Utilities\Form;

abstract class Base
{
    public $model;
    public $entity = '';

    public function buildData()
    {
        $data = [];

        foreach ((new \ReflectionClass($this))->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            $data[$property->getName()] = $property->getValue($this);
        }

        return $data;
    }

    abstract public function html();

    public function model($model)
    {
        $this->model = $model;

        $class = str_replace('App\\', '', get_class($model));

        $this->entity = implode('.', array_map(function ($ary) {
            return str_replace('_', '-', snake_case($ary));
        }, explode('\\', $class)));

        return $this;
    }
}
