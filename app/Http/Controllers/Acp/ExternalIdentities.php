<?php namespace App\Http\Controllers\Acp;

use App\ExternalIdentity as Model;

class ExternalIdentities extends CommonController
{
    public function index()
    {
        $models = Model::orderBy('id', 'desc')->paginate();

        return view($this->view, compact('models'));
    }
}
