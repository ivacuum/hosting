<?php namespace App\Http\Controllers;

use App\Mail\Feedback;
use App\News;
use App\Torrent;

class Ajax extends Controller
{
    public function comment($type, $id)
    {
        $mail = $this->request->input('mail');
        $text = e($this->request->input('text'));

        $validator = \Validator::make(compact('id', 'mail', 'text', 'type'), [
            'id' => 'integer|min:1',
            'mail' => 'empty',
            'text' => 'required',
            'type' => 'in:news,torrent'
        ]);

        $this->validateWith($validator);

        if ($type === 'news') {
            $model = News::find($id);
        } elseif ($type === 'torrent') {
            $model = Torrent::find($id);
        } else {
            throw new \Exception('Не выбран объект для комментирования');
        }

        $model->comments()->create([
            'html' => $text,
            'user_id' => $this->request->user()->id,
        ]);

        return redirect()->back()->with('message', 'Комментарий опубликован');
    }

    public function feedback()
    {
        $this->validate($this->request, [
            'mail' => 'empty',
            'text' => 'required',
        ]);

        $text = $this->request->input('text');
        $referer = $this->request->server('HTTP_REFERER');
        $question = $this->request->input('question');

        register_shutdown_function(function () use ($question, $referer, $text) {
            \Mail::send(new Feedback($referer, $question, $text));
        });

        return [
            'message' => trans('ajax.feedback.ok'),
            'status'  => 'OK',
        ];
    }
}
