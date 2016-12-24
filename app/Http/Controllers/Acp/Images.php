<?php namespace App\Http\Controllers\Acp;

use App\Image as Model;
use Carbon\Carbon;

class Images extends Controller
{
    protected $title_attr = 'id';

    public function index()
    {
        $type = $this->request->input('type');
        $year = $this->request->input('year');
        $touch = $this->request->input('touch');
        $user_id = $this->request->input('user_id');

        $models = Model::orderBy(Model::VIEWS, 'asc')->orderBy(Model::ID, 'desc');

        if ($year) {
            $models = $models->whereYear(Model::CREATED_AT, $year);
        }
        if ($touch) {
            $models = $models->whereYear(Model::UPDATED_AT, Carbon::now()->subYear($touch)->year);
        }
        if ($user_id) {
            $models = $models->where('user_id', $user_id);
        }

        $size = $models->sum(Model::SIZE);

        $models = $models->paginate()
            ->appends(compact('touch', 'type', 'user_id', 'year'));

        return view($this->view, compact('models', 'size', 'touch', 'type', 'year'));
    }

    public function batch()
    {
        $action = $this->request->input('action');
        $ids = $this->request->input('ids');

        switch ($action) {
            case 'delete':

                Model::destroy($ids);

            break;
        }

        return [
            'status' => 'OK',
            'redirect' => $this->request->header('referer'),
        ];
    }

    public function destroy(Model $model)
    {
        $model->delete();

        return [
            'status' => 'OK',
            'redirect' => $this->request->header('referer'), // action("{$this->class}@index"),
        ];
    }

    public function show(Model $model)
    {
        return view($this->view, compact('model'));
    }

    public function view(Model $model)
    {
        $model->touch = time();
        $model->views++;
        $model->save();

        return back();
    }
}
