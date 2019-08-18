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
        $onPage = request('on_page');

        [$sortKey, $sortDir] = $this->getSortParams();

        $models = Model::with('tags')
            ->forTrip(request('trip_id'))
            ->applyFilter($filter)
            ->forTag(request('tag_id'))
            ->orderBy($sortKey, $sortDir)
            ->paginate($onPage)
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
        $tripId = request('trip_id');

        if ($tripId) {
            $model = Trip::findOrFail($tripId);
        }

        $file = request()->file('file');

        if (null === $file || !$file->isValid()) {
            throw new \Exception('Необходимо предоставить хотя бы один файл');
        }

        try {
            $coords = ExifHelper::latLon(exif_read_data($file->getRealPath()));
        } catch (\Throwable $e) {
            $coords = ['lat' => null, 'lon' => null];
        }

        $image = (new ImageConverter)
            ->resize(2000, 2000)
            ->quality(75)
            ->convert($file->getRealPath());

        $pathinfo = pathinfo($file->getClientOriginalName());
        $extension = str_replace('jpeg', 'jpg', strtolower($pathinfo['extension']));
        $filename = "{$pathinfo['filename']}.{$extension}";

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
