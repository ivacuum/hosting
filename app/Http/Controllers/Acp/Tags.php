<?php namespace App\Http\Controllers\Acp;

use App\Tag as Model;
use Illuminate\Validation\Rule;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Tags extends Controller
{
    protected $sortDir = 'asc';
    protected $sortKey = 'title';
    protected $sortableKeys = ['title', 'views', 'photos_count'];
    protected $showWithCount = ['photos'];

    public function index()
    {
        [$sortKey, $sortDir] = $this->getSortParams();

        $sortKey = $sortKey === 'title' ? Model::titleField() : $sortKey;

        $models = Model::withCount('photos')
            ->orderBy($sortKey, $sortDir)
            ->paginate(500)
            ->withPath(path([self::class, 'index']));

        return view($this->view, [
            'models' => $models,
        ]);
    }

    /**
     * @param Model|null $model
     * @return array
     */
    protected function rules($model = null)
    {
        return [
            'title_ru' => [
                'required',
                Rule::unique('tags', 'title_ru')->ignore($model->id ?? null),
            ],
            'title_en' => [
                'required',
                Rule::unique('tags', 'title_en')->ignore($model->id ?? null),
            ],
        ];
    }
}
