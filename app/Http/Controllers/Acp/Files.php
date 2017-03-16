<?php namespace App\Http\Controllers\Acp;

use App\File as Model;
use Illuminate\Validation\Rule;

class Files extends CommonController
{
    public function index()
    {
        $models = Model::orderBy('id', 'desc')->paginate();

        return view($this->view, compact('models'));
    }

    /**
     * @param  Model|null $model
     * @return array
     */
    protected function rules($model = null)
    {
        return [
            'name' => 'required',
            'slug' => [
                'required',
                Rule::unique('files', 'slug')->ignore($model->id ?? null),
            ],
        ];
    }
}
