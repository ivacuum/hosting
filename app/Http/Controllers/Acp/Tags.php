<?php namespace App\Http\Controllers\Acp;

use App\Tag as Model;
use Illuminate\Validation\Rule;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Tags extends Controller
{
    protected $sort_dir = 'asc';
    protected $sort_key = 'title';
    protected $sortable_keys = ['title', 'views', 'photos_count'];
    protected $show_with_count = ['photos'];

    public function index()
    {
        [$sort_key, $sort_dir] = $this->getSortParams();

        $sort_key = $sort_key === 'title' ? Model::titleField() : $sort_key;

        $models = Model::withCount('photos')
            ->orderBy($sort_key, $sort_dir)
            ->get();

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
