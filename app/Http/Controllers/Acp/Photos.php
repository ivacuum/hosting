<?php namespace App\Http\Controllers\Acp;

use App\Photo as Model;
use App\Trip;
use App\Utilities\ExifHelper;

class Photos extends CommonController
{
    public function index()
    {
        $models = Model::with('tags')
            ->forTrip($this->request->input('trip_id'))
            ->orderBy('id', 'desc')
            ->paginate()
            ->appends($this->request->all());

        return view($this->view, compact('models'));
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

        $photo = $model->photos()->create([
            'lat' => $coords['lat'] ?? '',
            'lon' => $coords['lon'] ?? '',
            'slug' => "{$model->slug}/{$file->getClientOriginalName()}",
            'views' => 0,
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
