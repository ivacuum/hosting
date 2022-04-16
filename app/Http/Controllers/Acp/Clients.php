<?php namespace App\Http\Controllers\Acp;

use App\Client as Model;
use Illuminate\Validation\Rule;

class Clients extends AbstractController
{
    protected $showWithCount = ['domains'];

    public function index()
    {
        $models = Model::paginate();

        return view($this->view, ['models' => $models]);
    }

    /**
     * @param Model|null $model
     * @return array
     */
    protected function rules($model = null)
    {
        return [
            'name' => [
                'required',
                Rule::unique('clients', 'name')->ignore($model),
            ],
            'email' => 'email',
        ];
    }
}
