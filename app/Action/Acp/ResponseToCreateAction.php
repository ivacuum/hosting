<?php

namespace App\Action\Acp;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;

class ResponseToCreateAction
{
    public function execute(Model $model): View
    {
        return view('acp.livewire-create', [
            'model' => $model,
        ]);
    }
}
