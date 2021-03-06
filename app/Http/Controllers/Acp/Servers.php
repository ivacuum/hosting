<?php namespace App\Http\Controllers\Acp;

use App\Server as Model;

class Servers extends AbstractController
{
    public function index()
    {
        $models = Model::paginate();

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
