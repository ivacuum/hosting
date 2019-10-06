<?php namespace App\Http\Controllers\Acp;

use App\Client as Model;
use Illuminate\Validation\Rule;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Clients extends Controller
{
    protected $showWithCount = ['domains'];

    public function index()
    {
        $models = Model::paginate()
            ->withPath(path([$this->controller, 'index']));

        return view($this->view, ['models' => $models]);
    }

    /**
     * @param  Model|null $model
     * @return array
     */
    protected function rules($model = null)
    {
        return [
            'name' => [
                'required',
                Rule::unique('clients', 'name')->ignore($model->id ?? null),
            ],
            'email' => 'email',
        ];
    }
}
