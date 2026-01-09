<?php

namespace App\Utilities\Form;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;

abstract class Base implements Htmlable
{
    public $help;
    public $label;
    public $model;
    public $entity = '';
    public $classes = [];
    public $default;

    abstract public function html();

    public function buildData(): array
    {
        $data = [];

        foreach (new \ReflectionClass($this)->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            $data[$property->getName()] = $property->getValue($this);
        }

        return $data;
    }

    /**
     * @param  \Illuminate\Contracts\Support\Arrayable|array  $values
     * @return $this
     */
    public function classes($values): self
    {
        if ($values instanceof Arrayable) {
            $this->classes = $values->toArray();
        } else {
            $this->classes = $values;
        }

        return $this;
    }

    public function default($value): self
    {
        $this->default = $value;

        return $this;
    }

    public function help($text): self
    {
        $this->help = $text;

        return $this;
    }

    public function label($text): self
    {
        $this->label = $text;

        return $this;
    }

    public function model($model)
    {
        $this->model = $model;

        $class = str_replace('App\\', '', $model::class);

        $this->entity = implode('.', array_map(fn ($ary) => \Str::snake($ary, '-'), explode('\\', $class)));

        return $this;
    }
}
