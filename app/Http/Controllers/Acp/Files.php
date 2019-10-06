<?php namespace App\Http\Controllers\Acp;

use App\File as Model;
use Illuminate\Validation\Rule;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Files extends Controller
{
    protected $sortableKeys = ['id', 'size', 'downloads'];

    public function index()
    {
        [$sortKey, $sortDir] = $this->getSortParams();

        $models = Model::orderBy($sortKey, $sortDir)
            ->paginate()
            ->withPath(path([self::class, 'index']));

        return view($this->view, ['models' => $models]);
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
                Rule::unique('files', 'slug')->ignore($model->id ?? null),
            ],
            'file' => [
                empty($model->exists) ? 'required' : '',
                'file',
            ],
            'title' => 'required',
        ];
    }

    protected function storeModel()
    {
        $file = request()->file('file');
        $folder = request('folder');

        /** @var Model $model */
        $model = $this->newModel()->fill($this->requestDataForModel());
        $model->size = $file->getSize();
        $model->extension = $file->getClientOriginalExtension();
        $model->downloads = 0;
        $model->save();

        \Storage::disk('files')->putFileAs($folder, $file, $model->basename());

        return $model;
    }
}
