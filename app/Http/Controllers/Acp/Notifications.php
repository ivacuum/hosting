<?php namespace App\Http\Controllers\Acp;

use App\Notification as Model;

class Notifications extends CommonController
{
    public function index()
    {
        $models = Model::orderBy('created_at', 'desc')->paginate();

        return view($this->view, compact('models'));
    }
}
