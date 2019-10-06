<?php namespace App\Http\Controllers\Acp;

use App\DcppHub as Model;
use Ivacuum\Generic\Controllers\Acp\Controller;

class DcppHubs extends Controller
{
    public function index()
    {
        $models = Model::orderBy('title')->get();

        return view($this->view, ['models' => $models]);
    }

    /**
     * @param  Model|null $model
     * @return array
     */
    protected function rules($model = null)
    {
        return [
            'port' => 'required|integer|min:1|max:65535',
            'title' => 'required',
            'address' => 'required',
        ];
    }
}
