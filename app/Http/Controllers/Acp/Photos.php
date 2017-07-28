<?php namespace App\Http\Controllers\Acp;

use App\Photo as Model;
use App\Trip;
use Ivacuum\Generic\Controllers\Acp\Controller;
use Ivacuum\Generic\Utilities\ExifHelper;

class Photos extends Controller
{
    protected $sortable_keys = ['id', 'views'];

    public function index()
    {
        $filter = $this->request->input('filter');

        list($sort_key, $sort_dir) = $this->getSortParams();

        $models = Model::with('tags')
            ->forTrip($this->request->input('trip_id'))
            ->applyFilter($filter)
            ->forTag($this->request->input('tag_id'))
            ->orderBy($sort_key, $sort_dir)
            ->paginate();

        return view($this->view, compact('filter', 'models'));
    }

    /**
     * @param  Model $model
     * @return array
     */
    protected function redirectAfterStore($model)
    {
        return ['filename' => $model->slug];
    }

    protected function storeModel()
    {
        $model = null;
        $trip_id = $this->request->input('trip_id');

        if ($trip_id) {
            $model = Trip::findOrFail($trip_id);
        }

        $file = $this->request->file('file');

        if (is_null($file) || !$file->isValid()) {
            throw new \Exception('Необходимо предоставить хотя бы один файл');
        }

        try {
            $coords = ExifHelper::latLon(exif_read_data($file->getRealPath()));
        } catch (\ErrorException $e) {
            $coords = ['lat' => null, 'lon' => null];
        }

        $pathinfo = pathinfo($file->getClientOriginalName());
        $filename = $pathinfo['filename'].'.'.strtolower($pathinfo['extension']);

        $photo = $model->photos()->create([
            'lat' => $coords['lat'] ?? '',
            'lon' => $coords['lon'] ?? '',
            'slug' => "{$model->slug}/{$filename}",
            'views' => 0,
            'status' => Model::STATUS_HIDDEN,
            'user_id' => $this->request->user()->id,
        ]);

        return $photo;
    }

    protected function updateModel($model)
    {
        if ($this->request->has('tags')) {
            $model->tags()->sync($this->request->input('tags'));
        } else {
            $model->tags()->detach();
        }
    }
}
