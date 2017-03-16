<?php namespace App\Http\Controllers\Acp;

use App\Image as Model;
use Carbon\Carbon;

class Images extends CommonController
{
    public function index()
    {
        $type = $this->request->input('type');
        $year = $this->request->input('year');
        $touch = $this->request->input('touch');
        $user_id = $this->request->input('user_id');

        $models = Model::orderBy('id');
            // ->where('updated_at', '<', Carbon::now()->subYear()->toDateTimeString())
            // ->where('views', '<', 1000);

        if ($year) {
            $models = $models->whereYear('created_at', $year);
        }
        if ($touch) {
            $models = $models->whereYear('updated_at', Carbon::now()->subYear($touch)->year);
        }
        if ($user_id) {
            $models = $models->where('user_id', $user_id);
        }

        $models = $models->paginate()
            ->appends(compact('touch', 'type', 'user_id', 'year'));

        return view($this->view, compact('models', 'touch', 'type', 'user_id', 'year'));
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

    public function view($id)
    {
        $model = $this->getModel($id);

        $model->views++;
        $model->save();

        return back();
    }

    protected function redirectAfterDestroy()
    {
        return [
            'status' => 'OK',
            'redirect' => $this->request->header('referer'),
        ];
    }
}
