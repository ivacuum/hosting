<?php namespace App\Http\Controllers\Acp;

use App\Server as Model;

class Servers extends CommonController
{
    public function index()
    {
        $models = Model::paginate();

        return view($this->view, compact('models'));
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
        $input = $this->request->all();

        /* Сохранение ранее указанного пароля */
        $passwords = $this->request->only('ftp_pass');

        foreach ($passwords as $key => $value) {
            if (!$value) {
                unset($input[$key]);
            }
        }

        $model->update($input);
    }
}
