<?php namespace App\Http\Controllers\Acp;

use App\Notification as Model;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Notifications extends Controller
{
    public function index()
    {
        $models = Model::orderBy('created_at', 'desc')->paginate();

        return view($this->view, compact('models'));
    }
}
