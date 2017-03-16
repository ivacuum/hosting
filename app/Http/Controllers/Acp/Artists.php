<?php namespace App\Http\Controllers\Acp;

use App\Artist as Model;
use Illuminate\Validation\Rule;

class Artists extends CommonController
{
    public function index()
    {
        $models = Model::orderBy('title')->get();

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
                'bail',
                'required',
                Rule::unique('artists', 'slug')->ignore($model->id ?? null),
                Rule::unique('cities', 'slug')->ignore($model->id ?? null),
                Rule::unique('gigs', 'slug')->ignore($model->id ?? null),
                Rule::unique('trips', 'slug')->ignore($model->id ?? null),
            ],
            'title' => 'required',
        ];
    }
}
