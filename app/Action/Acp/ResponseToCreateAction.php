<?php namespace App\Action\Acp;

use Illuminate\Database\Eloquent\Model;

class ResponseToCreateAction
{
    public function execute(Model $model)
    {
        return view('acp.livewire-create', [
            'model' => $model,
        ]);
    }
}
