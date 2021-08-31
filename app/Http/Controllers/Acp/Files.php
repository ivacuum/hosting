<?php namespace App\Http\Controllers\Acp;

use App\File as Model;
use Illuminate\Validation\Rule;

class Files extends AbstractController
{
    protected $sortableKeys = ['id', 'size', 'downloads'];

    public function index()
    {
        $models = Model::query()
            ->orderBy($this->getSortKey(), $this->getSortDir())
            ->paginate();

        return view($this->view, ['models' => $models]);
    }

    /**
     * @param Model|null $model
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
                Rule::when(empty($model->exists), 'required'),
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
