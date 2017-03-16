<?php namespace App\Http\Controllers\Acp;

use App\Country as Model;
use Illuminate\Validation\Rule;

class Countries extends CommonController
{
    protected $show_with_count = ['cities'];

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
        return [
            'slug' => [
                'required',
                Rule::unique('countries', 'slug')->ignore($model->id ?? null),
            ],
            'title_ru' => 'required',
            'title_en' => 'required',
        ];
    }
}
