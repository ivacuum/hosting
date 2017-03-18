<?php namespace App\Http\Controllers\Acp;

use App\Tag as Model;
use Illuminate\Validation\Rule;

class Tags extends CommonController
{
    protected $show_with_count = ['photos'];

    public function index()
    {
        $models = Model::orderBy(Model::titleField())->get();

        return view($this->view, compact('models'));
    }

    /**
     * @param  Model|null $model
     * @return array
     */
    protected function rules($model = null)
    {
        $rules = [
            'title_ru' => [
                'required',
                Rule::unique('tags', 'title_ru')->ignore($model->id ?? null),
            ],
            'title_en' => [
                'required',
                Rule::unique('tags', 'title_en')->ignore($model->id ?? null),
            ],
        ];

        return $rules;
    }
}
