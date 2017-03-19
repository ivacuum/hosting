<?php namespace App\Http\Controllers\Acp;

use App\ExternalIdentity as Model;
use Ivacuum\Generic\Controllers\Acp\Controller;

class ExternalIdentities extends Controller
{
    public function index()
    {
        $models = Model::orderBy('id', 'desc')->paginate();

        return view($this->view, compact('models'));
    }
}
