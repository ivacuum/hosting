<?php namespace App\Http\Controllers\Acp;

use App\Gig;
use App\Photo as Model;
use App\Trip;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Ivacuum\Generic\Services\ImageConverter;
use Ivacuum\Generic\Utilities\ExifHelper;

class Photos extends AbstractController
{
    protected $sortableKeys = ['id', 'views'];

    public function index()
    {
        $filter = request('filter');
        $onPage = request('on_page');

        $models = Model::query()
            ->with('tags')
            ->forTrip(request('trip_id'))
            ->applyFilter($filter)
            ->forTag(request('tag_id'))
            ->orderBy($this->getSortKey(), $this->getSortDir())
            ->paginate($onPage);

        return view($this->view, [
            'filter' => $filter,
            'models' => $models,
        ]);
    }

    /**
     * @param Model $model
     * @return array
     */
    protected function redirectAfterStore($model)
    {
        return ['filename' => $model->slug];
    }

    protected function storeModel()
    {
        $model = null;
        $gigId = request('gig_id');
        $tripId = request('trip_id');

        if ($gigId) {
            $model = Gig::findOrFail($gigId);
        } elseif ($tripId) {
            $model = Trip::findOrFail($tripId);
        }

        $file = request()->file('file');

        if (null === $file || !$file->isValid()) {
            throw new \Exception('Необходимо предоставить хотя бы один файл');
        }

        try {
            $coords = ExifHelper::latLon(exif_read_data($file->getRealPath()));
        } catch (\Throwable) {
            $coords = ['lat' => null, 'lon' => null];
        }

        $image = (new ImageConverter)
            ->resize(2000, 2000)
            ->quality(75)
            ->convert($file->getRealPath());

        $pathinfo = pathinfo($file->getClientOriginalName());
        $extension = str_replace('jpeg', 'jpg', strtolower($pathinfo['extension']));
        $filename = "{$pathinfo['filename']}.{$extension}";

        $folder = $model instanceof Gig
            ? "gigs/{$model->slug}"
            : $model->slug;

        \Storage::disk('photos')->putFileAs($folder, $image, $filename);

        /** @var \App\Photo $photo */
        $photo = $model->photos()->make();
        $photo->lat = $coords['lat'] ?? '';
        $photo->lon = $coords['lon'] ?? '';
        $photo->slug = "{$model->slug}/{$filename}";
        $photo->point = $photo->lat
            ? new Point($photo->lat, $photo->lon, 4326)
            : null;
        $photo->views = 0;
        $photo->status = Model::STATUS_HIDDEN;
        $photo->user_id = request()->user()->id;
        $photo->save();

        return $photo;
    }

    protected function updateModel($model)
    {
        /** @var Model $model */
        $model->tags()->sync(request('tags', []));
    }
}
