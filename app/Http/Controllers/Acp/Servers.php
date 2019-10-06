<?php namespace App\Http\Controllers\Acp;

use App\Server as Model;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Servers extends Controller
{
    public function index()
    {
        $models = Model::paginate()
            ->withPath(path([self::class, 'index']));

        return view($this->view, ['models' => $models]);
    }

    protected function rules($model = null)
    {
        return [
            'host' => 'required',
            'title' => 'required',
        ];
    }

    protected function updateModel($model)
    {
        $input = $this->requestDataForModel();

        /* Сохранение ранее указанного пароля */
        $passwords = request(['ftp_pass']);

        foreach ($passwords as $key => $value) {
            if (!$value) {
                unset($input[$key]);
            }
        }

        $model->update($input);
    }
}
