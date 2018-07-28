<?php namespace App\Http\Controllers\Acp;

use App\Artist as Model;
use Illuminate\Validation\Rule;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Artists extends Controller
{
    protected $api_only = true;

    public function index()
    {
        $models = Model::orderBy('title')
            ->paginate(500)
            ->withPath(path("{$this->class}@index"));

        return $this->modelResourceCollection($models);
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
                Rule::unique('trips', 'slug')
                    ->where('user_id', 1)
                    ->ignore($model->id ?? null),
            ],
            'title' => 'required',
        ];
    }
}
