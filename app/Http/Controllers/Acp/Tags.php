<?php namespace App\Http\Controllers\Acp;

use App\Tag as Model;
use Illuminate\Validation\Rule;

class Tags extends AbstractController
{
    protected $sortDir = 'asc';
    protected $sortKey = 'title';
    protected $sortableKeys = ['title', 'views', 'photos_count'];
    protected $showWithCount = ['photos'];

    public function index()
    {
        $models = Model::query()
            ->withCount('photos')
            ->orderBy($this->getSortKey(), $this->getSortDir())
            ->paginate(500);

        return view($this->view, ['models' => $models]);
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
                Rule::unique('tags', 'title_ru')->ignore($model),
            ],
            'title_en' => [
                'required',
                Rule::unique('tags', 'title_en')->ignore($model),
            ],
        ];
    }
}
