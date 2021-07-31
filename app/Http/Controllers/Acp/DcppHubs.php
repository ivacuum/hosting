<?php namespace App\Http\Controllers\Acp;

use App\DcppHub as Model;
use Ivacuum\Generic\Controllers\Acp\UsesLivewire;

class DcppHubs extends AbstractController implements UsesLivewire
{
    public function index()
    {
        $models = Model::orderBy('title')->get();

        return view($this->view, ['models' => $models]);
    }
}
