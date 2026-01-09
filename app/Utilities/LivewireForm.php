<?php

namespace App\Utilities;

class LivewireForm
{
    private object|string $model;

    public function checkbox(...$parameters): LivewireForm\Checkbox
    {
        return $this->applySettings(new LivewireForm\Checkbox(...$parameters));
    }

    public function datetimeLocal(...$parameters): LivewireForm\DatetimeLocal
    {
        return $this->applySettings(new LivewireForm\DatetimeLocal(...$parameters));
    }

    public function model($model)
    {
        $this->model = $model;

        return $this;
    }

    public function radio(...$parameters): LivewireForm\Radio
    {
        return $this->applySettings(new LivewireForm\Radio(...$parameters));
    }

    public function select(...$parameters): LivewireForm\Select
    {
        return $this->applySettings(new LivewireForm\Select(...$parameters));
    }

    public function text(...$parameters): LivewireForm\Text
    {
        return $this->applySettings(new LivewireForm\Text(...$parameters));
    }

    public function textarea(...$parameters): LivewireForm\Textarea
    {
        return $this->applySettings(new LivewireForm\Textarea(...$parameters));
    }

    private function applySettings(LivewireForm\Checkbox|LivewireForm\DatetimeLocal|LivewireForm\Radio|LivewireForm\Select|LivewireForm\Text|LivewireForm\Textarea $form)
    {
        return $form->model($this->model);
    }
}
