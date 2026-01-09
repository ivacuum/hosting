<?php

namespace App\Utilities\LivewireForm;

use App\Facades\ViewHelper;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;

abstract class Base implements Htmlable
{
    public $model;
    public bool $blur = false;
    public bool $live = false;
    public bool $required = false;
    public array $classes = [];
    public string $name;
    public string $entity = '';
    public string|null $help = null;
    public string|null $label = null;

    abstract public function html();

    public function blur(): self
    {
        $this->blur = true;

        return $this;
    }

    public function buildData(): array
    {
        $data = [];
        $properties = new \ReflectionClass($this)->getProperties(\ReflectionProperty::IS_PUBLIC);

        foreach ($properties as $property) {
            $data[$property->getName()] = $property->getValue($this);
        }

        if ($data['label'] === null) {
            $model = $this->entity;
            $field = str($this->name)->snake();

            if (str_contains($this->name, '.')) {
                $model = str($this->name)->beforeLast('.')->snake('-');
                $field = str($this->name)->afterLast('.')->snake();
            }

            $data['label'] = ViewHelper::modelFieldTrans($model, $field);
        }

        return $data;
    }

    public function classes($values): self
    {
        if ($values instanceof Arrayable) {
            $this->classes = $values->toArray();
        } else {
            $this->classes = $values;
        }

        return $this;
    }

    public function help(string $text): self
    {
        $this->help = $text;

        return $this;
    }

    public function i18n(string $field, string|null $model = null)
    {
        $this->label = ViewHelper::modelFieldTrans($model ?? $this->entity, $field);

        return $this;
    }

    public function label(string $text): self
    {
        $this->label = $text !== ''
            ? __($text)
            : $text;

        return $this;
    }

    public function live(): self
    {
        $this->live = true;

        return $this;
    }

    public function model(string|object $model)
    {
        $modelAsString = is_object($model)
            ? $model::class
            : $model;

        $this->entity = str($modelAsString)
            ->afterLast('\\')
            ->snake('-');

        return $this;
    }

    public function required(bool $value = true): self
    {
        $this->required = $value;

        return $this;
    }
}
