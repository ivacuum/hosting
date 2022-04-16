<?php namespace App\Http\Controllers\Acp;

use App\Artist as Model;
use App\Rules\LifeSlug;

class Artists extends AbstractController
{
    public function index()
    {
        $models = Model::query()
            ->orderBy('title')
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
            'slug' => LifeSlug::rules($model),
            'title' => 'required',
        ];
    }
}
