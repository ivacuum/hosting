<?php

namespace App\Action\Acp;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;

class ResponseToEditAction
{
    public function execute(Model $model): View
    {
        return view('acp.livewire-edit', [
            'model' => $model,
            'modelTpl' => str($model::class)
                ->afterLast('\\')
                ->snake('-'),
        ]);
    }
}
