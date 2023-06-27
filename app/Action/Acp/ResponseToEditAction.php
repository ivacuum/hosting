<?php

namespace App\Action\Acp;

use Illuminate\Database\Eloquent\Model;

class ResponseToEditAction
{
    public function execute(Model $model)
    {
        return view('acp.livewire-edit', [
            'model' => $model,
        ]);
    }
}
