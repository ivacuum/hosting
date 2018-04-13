<?php namespace App\Http\Controllers\Acp;

use App\Photo as Model;
use App\Trip;
use Ivacuum\Generic\Controllers\Acp\Controller;
use Ivacuum\Generic\Services\ImageConverter;
use Ivacuum\Generic\Utilities\ExifHelper;

class Photos extends Controller
{
    protected $sortable_keys = ['id', 'views'];

    public function index()
    {
        $filter = request('filter');

        [$sort_key, $sort_dir] = $this->getSortParams();

        $models = Model::with('tags')
            ->forTrip(request('trip_id'))
            ->applyFilter($filter)
            ->forTag(request('tag_id'))
            ->orderBy($sort_key, $sort_dir)
            ->paginate()
            ->withPath(path("{$this->class}@index"));

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
        $trip_id = request('trip_id');

        if ($trip_id) {
            $model = Trip::findOrFail($trip_id);
        }

        $file = request()->file('file');

        if (null === $file || !$file->isValid()) {
            throw new \Exception('Необходимо предоставить хотя бы один файл');
        }

        try {
            $coords = ExifHelper::latLon(exif_read_data($file->getRealPath()));
        } catch (\ErrorException $e) {
            $coords = ['lat' => null, 'lon' => null];
        }

        $image = (new ImageConverter)
            ->resize(2000, 2000)
            ->quality(75)
            ->convert($file->getRealPath());

        $pathinfo = pathinfo($file->getClientOriginalName());
        $filename = $pathinfo['filename'].'.'.strtolower($pathinfo['extension']);

        \Storage::disk('photos')->putFileAs($model->slug, $image, $filename);

        $photo = $model->photos()->create([
            'lat' => $coords['lat'] ?? '',
            'lon' => $coords['lon'] ?? '',
            'slug' => "{$model->slug}/{$filename}",
            'views' => 0,
            'status' => Model::STATUS_HIDDEN,
            'user_id' => request()->user()->id,
        ]);

        return $photo;
    }

    protected function updateModel($model)
    {
        $model->tags()->sync(request('tags', []));
    }
}
